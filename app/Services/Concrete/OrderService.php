<?php

namespace App\Services\Concrete;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Enums\BookingStatus;
use App\Mail\BookingPaidMail;
use App\Mail\OrderPaidMail;
use App\Models\ActivityTimeSlot;
use App\Models\CustomerCard;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use ReflectionClass;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class OrderService
{
    protected $model_order;
    protected $model_order_detail;
    protected $model_activity_time_slot;
    protected $model_customer_card;
    protected $model_user;
    public function __construct()
    {
        // set the model
        $this->model_order = new Repository(new Order);
        $this->model_order_detail = new Repository(new OrderDetail);
        $this->model_activity_time_slot = new Repository(new ActivityTimeSlot);
        $this->model_customer_card = new Repository(new CustomerCard);
        $this->model_user = new Repository(new User);
    }
    //booking
    public function getSource()
    {
        $model = $this->model_order->getModel()::where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('status', function ($item) {
                $reflection = new ReflectionClass(BookingStatus::class);
                $statuses = $reflection->getConstants();

                $options = '';
                foreach ($statuses as $status) {
                    $selected = $item->status === $status ? 'selected' : '';
                    $label = ucfirst(str_replace('_', ' ', $status));
                    $options .= "<option value='{$status}' {$selected}>{$label}</option>";
                }

                return "<select class='order-status-dropdown form-control' data-id='{$item->id}'>{$options}</select>";
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $view_column    = "<a class='text-success mr-2' href='order/view/" . $item->id . "'><i title='view' class='nav-icon mr-2 fa fa-eye'></i>View</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteOrder' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('order_view'))
                $action_column .= $view_column;
                // if (Auth::user()->can('order_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
        return $data;
    }

    // get all
    public function getAll()
    {
        return $this->model_order->getModel()::where('is_deleted', 0)->get();
    }

    // get by id
    public function getById($id)
    {
        $order = $this->model_order->getModel()::with([
            'orderDetail',
            'orderDetail.activity',
            'orderDetail.activity_date',
            'orderDetail.activity_time_slot',
            'user',
            'card',
            'currency'
        ])->find($id);

        if (!$order)
            return false;

        return $order;
    }
    public function statusById($data)
    {
        $order = $this->model_order->getModel()::findOrFail($data['order_id']);
        if (!$order) {
            return false;
        }
        if ($data['status'] == 'confirmed') {
            foreach ($order->orderDetail as $item) {
                $this->model_activity_time_slot->getModel()
                    ::where('id', $item->activity_time_slot_id)
                    ->decrement('available_seats', $item->quantity);
            }
        }
        // If status is being set to "paid", charge the customer via Stripe
        if ($data['status'] === 'paid') {
            // Get the payment method from card_id
            $customer_card = $this->model_customer_card->getModel()::findOrFail($order->card_id);

            if (!$customer_card || !$customer_card->stripe_payment_method_id) {
                throw new \Exception("No valid card found for payment.");
            }

            // Set your Stripe secret key
            Stripe::setApiKey(config('services.stripe.secret_key'));

            // Retrieve the Stripe customer ID from your User model (assumed)
            $user = $this->model_user->getModel()::findOrFail($order->user_id);

            if (!$user || !$user->stripe_customer_id) {
                throw new \Exception("Stripe customer not found.");
            }

            // Create a PaymentIntent and confirm it
            $paymentIntent = PaymentIntent::create([
                'amount' => intval($order->total * 100), // amount in cents
                'currency' => strtolower($order->currency->code ?? 'usd'),
                'customer' => $user->stripe_customer_id,
                'payment_method' => $customer_card->stripe_payment_method_id,
                'off_session' => true,
                'confirm' => true,
                'description' => 'Order Payment for Order #' . $order->id,
            ]);

            if ($paymentIntent->status !== 'succeeded') {
                throw new \Exception("Payment failed. Status: " . $paymentIntent->status);
            }

            // Send email to customer after successful payment
            Mail::to($order->email)->send(new OrderPaidMail($order));
        }

        $order->status = $data['status'];
        $order->update();

        if (!$order)
            return false;

        return $order;
    }

    // delete by id
    public function deleteById($id)
    {
        $booking = $this->model_order->getModel()::find($id);
        $booking->is_deleted = 1;
        $booking->deletedby_id = Auth::user()->id;
        $booking->date_deleted = Carbon::now();
        $booking->update();

        if (!$booking)
            return false;

        return $booking;
    }
}
