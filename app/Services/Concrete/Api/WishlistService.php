<?php

namespace App\Services\Concrete\Api;

use App\Models\Wishlist;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WishlistService
{
      protected $model_wishlist;
      public function __construct()
      {
            // set the model
            $this->model_wishlist = new Repository(new Wishlist);
      }
      // save
      public function save($obj)
      {
            $obj['user_id'] = Auth::User()->id;
            $saved_obj = $this->model_wishlist->create($obj);

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get by user id
      public function getByUserId()
      {
            $wishlist = $this->model_wishlist->getModel()::with(['tour', 'activity', 'user'])
                  ->where('user_id', Auth::User()->id)->get();

            if (!$wishlist)
                  return false;

            return $wishlist;
      }

      // get by id
      public function getById($id)
      {
            $wishlist = $this->model_wishlist->getModel()::find($id);

            if (!$wishlist)
                  return false;

            return $wishlist;
      }

      // delete by id
      public function deleteBy($data)
      {
            if (!empty($data['tour_id']) && $data['tour_id'] != null) {
                  $wishlist = $this->model_wishlist->getModel()::where('tour_id', $data['tour_id'])->where('user_id', Auth::User()->id)->first();
            }
            if (!empty($data['activity_id']) && $data['activity_id'] != null) {
                  $wishlist = $this->model_wishlist->getModel()::where('activity_id', $data['activity_id'])->where('user_id', Auth::User()->id)->first();
            }
            if ($wishlist) {
                  $wishlist->delete();
            } else {
                  return false;
            }
            return true;
      }
}
