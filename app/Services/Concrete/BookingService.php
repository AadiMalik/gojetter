<?php

namespace App\Services\Concrete;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Enums\BookingStatus;
use App\Mail\BookingPaidMail;
use App\Models\CustomerCard;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use ReflectionClass;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class BookingService
{
    protected $model_booking;
    protected $model_booking_detail;
    protected $model_customer_card;
    protected $model_user;
    public function __construct()
    {
        // set the model
        $this->model_booking = new Repository(new Booking);
        $this->model_booking_detail = new Repository(new BookingDetail);
        $this->model_customer_card = new Repository(new CustomerCard);
        $this->model_user = new Repository(new User);
    }
    //booking
    public function getSource()
    {
        $model = $this->model_booking->getModel()::where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('tour', function ($item) {
                return $item->tour->title ?? '';
            })
            ->addColumn('tour_date', function ($item) {
                return $item->tour_date->start_date .' - '.$item->tour_date->end_date;
            })
            ->addColumn('status', function ($item) {
                $reflection = new ReflectionClass(BookingStatus::class);
                $statuses = $reflection->getConstants();

                $options = '';
                foreach ($statuses as $status) {
                    $selected = $item->status === $status ? 'selected' : '';
                    $label = ucfirst(str_replace('_', ' ', $status));
                    $options .= "<option value='{$status}' {$selected}>{$label}</option>";
                }

                return "<select class='booking-status-dropdown form-control' data-id='{$item->id}'>{$options}</select>";
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $view_column    = "<a class='text-success mr-2' href='booking/view/" . $item->id . "'><i title='view' class='nav-icon mr-2 fa fa-eye'></i>View</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteBooking' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('booking_view'))
                $action_column .= $view_column;
                if (Auth::user()->can('booking_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['tour','tour_date', 'status', 'action'])
            ->make(true);
        return $data;
    }

    // get all
    public function getAll()
    {
        return $this->model_booking->getModel()::where('is_deleted', 0)->get();
    }

    // get by id
    public function getById($id)
    {
        $booking = $this->model_booking->getModel()::with(['tour', 'user'])->find($id);

        if (!$booking)
            return false;

        return $booking;
    }
    // get by id
    public function getDetailById($id)
    {
        $booking = $this->model_booking->getModel()::with(['tour','tour_date', 'user'])->find($id);
        $booking_detail = $this->model_booking_detail->getModel()::where('booking_id', $id)->where('is_deleted', 0)->get();
        $booking->booking_detail = $booking_detail;

        if (!$booking)
            return false;

        return $booking;
    }
    public function statusById($data)
    {
        $booking = $this->model_booking->getModel()::findOrFail($data['booking_id']);
        if (!$booking) {
            return false;
        }
        // If status is being set to "paid", charge the customer via Stripe
        if ($data['status'] === 'paid') {
            // Get the payment method from card_id
            $customer_card = $this->model_customer_card->getModel()::findOrFail($booking->card_id);

            if (!$customer_card || !$customer_card->stripe_payment_method_id) {
                throw new \Exception("No valid card found for payment.");
            }

            // Set your Stripe secret key
            Stripe::setApiKey(config('services.stripe.secret_key'));

            // Retrieve the Stripe customer ID from your User model (assumed)
            $user = $this->model_user->getModel()::findOrFail($booking->user_id);

            if (!$user || !$user->stripe_customer_id) {
                throw new \Exception("Stripe customer not found.");
            }

            // Create a PaymentIntent and confirm it
            $paymentIntent = PaymentIntent::create([
                'amount' => intval($booking->total * 100), // amount in cents
                'currency' => strtolower($booking->currency ?? 'usd'),
                'customer' => $user->stripe_customer_id,
                'payment_method' => $customer_card->stripe_payment_method_id,
                'off_session' => true,
                'confirm' => true,
                'description' => 'Tour Booking Payment for Booking #' . $booking->id,
            ]);

            if ($paymentIntent->status !== 'succeeded') {
                throw new \Exception("Payment failed. Status: " . $paymentIntent->status);
            }

            // Send email to customer after successful payment
            Mail::to($booking->email)->send(new BookingPaidMail($booking));
        }

        $booking->status = $data['status'];
        $booking->update();

        if (!$booking)
            return false;

        return $booking;
    }

    // delete by id
    public function deleteById($id)
    {
        $booking = $this->model_booking->getModel()::find($id);
        $booking->is_deleted = 1;
        $booking->deletedby_id = Auth::user()->id;
        $booking->date_deleted = Carbon::now();
        $booking->update();

        if (!$booking)
            return false;

        return $booking;
    }

    ///////////////////////// API /////////////////////////

    //list
    public function getBookingByUser()
    {
        return $this->model_booking->getModel()::with([
            'tour',
            'tour_date',
            'user',
            'currency',
            'bookingDetail'
        ])
            ->where('is_deleted', 0)
            ->where('user_id', Auth::User()->id)
            ->get();
    }
    // save
    public function save(array $obj)
    {
        DB::beginTransaction();

        try {
            $userId = Auth::id();
            $obj['createdby_id'] = $userId;

            // Create booking
            $booking = $this->model_booking->create($obj);

            // Create booking details
            foreach ($obj['booking_details'] as $detail) {
                $detail['booking_id'] = $booking->id;
                $detail['createdby_id'] = $userId;
                $this->model_booking_detail->create($detail);
            }

            DB::commit();
            return $this->getById($booking->id);
        } catch (\Throwable $e) {
            DB::rollBack();

            // Optional: log the error
            Log::error('Booking save failed: ' . $e->getMessage());

            return false;
        }
    }
}
