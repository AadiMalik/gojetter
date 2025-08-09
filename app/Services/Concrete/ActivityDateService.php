<?php

namespace App\Services\Concrete;

use App\Models\ActivityDate;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityDateService
{
    protected $model_activity_date;
    public function __construct()
    {
        // set the model
        $this->model_activity_date = new Repository(new ActivityDate);
    }
    //Bead type
    public function getSource($data)
    {
        $model = $this->model_activity_date->getModel()::with('activity')
        ->where('activity_id', $data['activity_id'])
        ->where('is_deleted',0);
        $data = DataTables::of($model)
            ->addColumn('activity', function ($item) {

                return $item->activity->title ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $time_slot_column = "<a class='text-warning mr-2' href='".url('activity-time-slot')."/" . $item->id . "'><i class='fa fa-calendar mr-1'></i> Time Slots</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteActivityDate' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('activity_time_slot_access'))
                $action_column .= $time_slot_column;
                // if (Auth::user()->can('activity_date_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['activity', 'action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {

        $obj['createdby_id'] = Auth::User()->id;
        $saved_obj = $this->model_activity_date->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity_date = $this->model_activity_date->getModel()::find($id);

        if (!$activity_date)
            return false;

        return $activity_date;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity_date = $this->model_activity_date->getModel()::find($id);
        $activity_date->is_deleted = 1;
        $activity_date->deletedby_id = Auth::user()->id;
        $activity_date->date_deleted = Carbon::now();
        $activity_date->update();

        if (!$activity_date)
            return false;

        return true;
    }
}
