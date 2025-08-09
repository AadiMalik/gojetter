<?php

namespace App\Services\Concrete\Api;

use App\Models\ActivityTimeSlot;
use App\Models\Cart;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;

class CartService
{
      protected $model_cart;
      public function __construct()
      {
            // set the model
            $this->model_cart = new Repository(new Cart());
      }
      public function checkAvailable($data)
      {
            $timeSlot = ActivityTimeSlot::where('id', $data['activity_time_slot_id'])
                  ->where('activity_date_id', $data['activity_date_id'])
                  ->where('is_deleted',0)
                  ->first();

            if (!$timeSlot) {
                  return "Invalid time slot for this date.";
            }

            // Check availability
            if ($timeSlot->available_seats < $data['quantity']) {
                  return "Not enough seats available.";
            }
            return true;
      }
      // save
      public function save($obj)
      {
            $obj['user_id'] = Auth::User()->id;
            $saved_obj = $this->model_cart->create($obj);

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get by user id
      public function getByUserId()
      {
            $cart = $this->model_cart->getModel()::with(['activity', 'activity_date', 'activity_time_slot', 'user'])
                  ->where('user_id', Auth::User()->id)->get();

            if (!$cart)
                  return false;

            return $cart;
      }

      // get by id
      public function getById($id)
      {
            $cart = $this->model_cart->getModel()::find($id);

            if (!$cart)
                  return false;

            return $cart;
      }

      // delete by id
      public function deleteById($id)
      {
            $cart = $this->model_cart->getModel()::find($id);
            $cart->delete();

            if (!$cart)
                  return false;

            return true;
      }
}
