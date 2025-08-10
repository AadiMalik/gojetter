<?php

namespace App\Services\Concrete\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repository\Repository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
      protected $model_order;
      protected $model_order_detail;
      protected $model_cart;
      public function __construct()
      {
            // set the model
            $this->model_order = new Repository(new Order());
            $this->model_order_detail = new Repository(new OrderDetail());
            $this->model_cart = new Repository(new Cart());
      }
      public function list()
      {

            return $this->model_order->getModel()::with(['orderDetail', 'user', 'card', 'currency'])
                  ->where('user_id', auth()->user()->id)
                  ->get();
      }

      public function save($data)
      {
            DB::beginTransaction();
            try {
                  $user_id = auth()->id();
                  $cart_items = $this->model_cart->getModel()::with('activity')->where('user_id', $user_id)->get();

                  if ($cart_items->isEmpty()) {
                        return 'Cart is empty';
                  }

                  $sub_total = $cart_items->sum(fn($item) => $item->quantity * $item->activity_date->price);
                  $quantity = $cart_items->sum(fn($item) => $item->quantity);
                  $discount = $data['discount'];
                  $total = $sub_total - $discount;

                  $order_obj = [
                        'user_id'         => $user_id,
                        'order_date'      => now(),
                        'first_name'      => $data['first_name'],
                        'last_name'       => $data['last_name'],
                        'email'           => $data['email'],
                        'phone'           => $data['phone'],
                        'country'         => $data['country'],
                        'zipcode'         => $data['zipcode'],
                        'address'         => $data['address'],
                        'sub_total'       => $sub_total,
                        'tax_percent'     => 0,
                        'tax_amount'      => 0,
                        'discount'        => $discount,
                        'quantity'        => $quantity,
                        'total'           => $total,
                        'payment_method'  => $data['payment_method'],
                        'card_id'         => $data['card_id'],
                        'currency_id'     => $data['currency_id'],
                        'coupon_id'       => $data['coupon_id'],
                        'status'          => 'pending',
                        'createdby_id'    => $user_id,
                        'created_at'      => now()
                  ];
                  $order = $this->model_order->getModel()::create($order_obj);
                  foreach ($cart_items as $item) {
                        $order_detail_obj = [
                              'order_id'              => $order->id,
                              'activity_id'           => $item->activity_id,
                              'activity_date_id'      => $item->activity_date_id,
                              'activity_time_slot_id' => $item->activity_time_slot_id,
                              'quantity'              => $item->quantity,
                              'price'                 => $item->activity_date->price,
                              'total'                 => $item->quantity * $item->activity_date->price
                        ];
                        $this->model_order_detail->getModel()::create($order_detail_obj);
                  }
                  Cart::where('user_id', $user_id)->delete();

                  DB::commit();
                  return true;
            } catch (Exception $e) {
                  DB::rollBack();
                  return $e;
            }
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

      // delete by id
      public function deleteById($id)
      {
            $order = $this->model_order->getModel()::find($id);
            $order->is_deleted = 1;
            $order->deletedby_id = auth()->user()->id;
            $order->date_deleted = now();
            $order->update();

            if (!$order)
                  return false;

            return true;
      }
}
