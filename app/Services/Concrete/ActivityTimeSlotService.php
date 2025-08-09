<?php

namespace App\Services\Concrete;

use App\Models\ActivityTimeSlot;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityTimeSlotService
{
    protected $model_activity_time_slot;
    public function __construct()
    {
        // set the model
        $this->model_activity_time_slot = new Repository(new ActivityTimeSlot());
    }
    
    public function getSource($data)
    {
        $model = $this->model_activity_time_slot->getModel()::with('activity_date')
        ->where('activity_date_id', $data['activity_date_id'])
        ->where('is_deleted',0);
        $data = DataTables::of($model)
            ->addColumn('activity_date', function ($item) {

                return $item->activity_date->date ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteActivityTimeSlot' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('activity_time_slot_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['activity_date','action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {
      $obj['createdby_id'] = Auth::User()->id;
        $saved_obj = $this->model_activity_time_slot->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity_time_slot = $this->model_activity_time_slot->getModel()::find($id);

        if (!$activity_time_slot)
            return false;

        return $activity_time_slot;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity_time_slot = $this->model_activity_time_slot->getModel()::find($id);
        $activity_time_slot->is_deleted = 1;
        $activity_time_slot->deletedby_id = Auth::user()->id;
        $activity_time_slot->date_deleted = Carbon::now();
        $activity_time_slot->update();

        if (!$activity_time_slot)
            return false;

        return true;
    }
}
