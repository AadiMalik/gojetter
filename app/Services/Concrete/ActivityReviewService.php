<?php

namespace App\Services\Concrete;

use App\Models\ActivityReview;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityReviewService
{
      protected $model_activity_review;
      public function __construct()
      {
            // set the model
            $this->model_activity_review = new Repository(new ActivityReview);
      }
      //Bead type
      public function getSource()
      {
            $model = $this->model_activity_review->getModel()::where('is_deleted', 0);
            $data = DataTables::of($model)
                  ->addColumn('activity', function ($item) {
                        return $item->activity->title ?? '';
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
                        $delete_column    = "<a class='text-danger mr-2' id='deleteActivityReview' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";

                        // if (Auth::user()->can('activity_review_delete'))
                        $action_column .= $delete_column;

                        return $action_column;
                  })
                  ->rawColumns(['activity', 'user', 'is_active', 'action'])
                  ->make(true);
            return $data;
      }
      // get all active by activity id
      public function getAllActiveByActivityId($activity_id)
      {
            return $this->model_activity_review->getModel()::where('is_deleted', 0)
                  ->where('is_active', 1)
                  ->where('activity_id', $activity_id)
                  ->get();
      }
      // get all active
      public function getAllActive()
      {
            return $this->model_activity_review->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
      }
      // save
      public function save($obj)
      {
            $obj['user_id'] = Auth::User()->id;
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_activity_review->create($obj);

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get by id
      public function getById($id)
      {
            $activity_review = $this->model_activity_review->getModel()::find($id);

            if (!$activity_review)
                  return false;

            return $activity_review;
      }
      public function statusById($id)
      {
            $activity_review = $this->model_activity_review->getModel()::find($id);
            if ($activity_review->is_active == 1) {
                  $activity_review->is_active = 0;
            } else {

                  $activity_review->is_active = 1;
            }
            $activity_review->update();
            if (!$activity_review)
                  return false;

            return $activity_review;
      }

      // delete by id
      public function deleteById($id)
      {
            $activity_review = $this->model_activity_review->getModel()::find($id);
            $activity_review->is_deleted = 1;
            $activity_review->deletedby_id = Auth::user()->id;
            $activity_review->date_deleted = Carbon::now();
            $activity_review->update();

            if (!$activity_review)
                  return false;

            return $activity_review;
      }
}
