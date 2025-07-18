<?php

namespace App\Services\Concrete;

use App\Models\TourReview;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourReviewService
{
      protected $model_tour_review;
      public function __construct()
      {
            // set the model
            $this->model_tour_review = new Repository(new TourReview);
      }
      //Bead type
      public function getSource()
      {
            $model = $this->model_tour_review->getModel()::where('is_deleted', 0);
            $data = DataTables::of($model)
                  ->addColumn('tour', function ($item) {
                        return $item->tour->title ?? '';
                  })
                  ->addColumn('user', function ($item) {
                        return $item->user->name ?? '';
                  })
                  ->addColumn('is_active', function ($item) {
                        if ($item->is_active == 1) {
                              $active = '<label class="switch pr-5 switch-primary mr-3"><input type="checkbox" checked="checked" id="active" data-id="' . $item->id . '"><span class="slider"></span></label>';
                        } else {
                              $active = '<label class="switch pr-5 switch-primary mr-3"><input type="checkbox" id="active" data-id="' . $item->id . '"><span class="slider"></span></label>';
                        }
                        return $active;
                  })
                  ->addColumn('action', function ($item) {
                        $action_column = '';
                        $delete_column    = "<a class='text-danger mr-2' id='deleteTourReview' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";

                        // if (Auth::user()->can('tour_review_delete'))
                        $action_column .= $delete_column;

                        return $action_column;
                  })
                  ->rawColumns(['tour', 'user', 'is_active', 'action'])
                  ->make(true);
            return $data;
      }
      // get all active by tour id
      public function getAllActiveByTourId($tour_id)
      {
            return $this->model_tour_review->getModel()::where('is_deleted', 0)
                  ->where('is_active', 1)
                  ->where('tour_id', $tour_id)
                  ->get();
      }
      // get all active
      public function getAllActive()
      {
            return $this->model_tour_review->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
      }
      // save
      public function save($obj)
      {
            $obj['user_id'] = Auth::User()->id;
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_tour_review->create($obj);

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get by id
      public function getById($id)
      {
            $tour_review = $this->model_tour_review->getModel()::find($id);

            if (!$tour_review)
                  return false;

            return $tour_review;
      }
      public function statusById($id)
      {
            $tour_review = $this->model_tour_review->getModel()::find($id);
            if ($tour_review->is_active == 1) {
                  $tour_review->is_active = 0;
            } else {

                  $tour_review->is_active = 1;
            }
            $tour_review->update();
            if (!$tour_review)
                  return false;

            return $tour_review;
      }

      // delete by id
      public function deleteById($id)
      {
            $tour_review = $this->model_tour_review->getModel()::find($id);
            $tour_review->is_deleted = 1;
            $tour_review->deletedby_id = Auth::user()->id;
            $tour_review->date_deleted = Carbon::now();
            $tour_review->update();

            if (!$tour_review)
                  return false;

            return $tour_review;
      }
}
