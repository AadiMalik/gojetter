<?php

namespace App\Services\Concrete;

use App\Models\ActivityInclusion;
use App\Models\ActivityNotSuitable;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityNotSuitableService
{
    protected $model_activity_not_suitable;
    public function __construct()
    {
        // set the model
        $this->model_activity_not_suitable = new Repository(new ActivityNotSuitable());
    }
    
    public function getSource($data)
    {
        $model = $this->model_activity_not_suitable->getModel()::with('activity')
        ->where('activity_id', $data['activity_id']);
        $data = DataTables::of($model)
            ->addColumn('activity', function ($item) {

                return $item->activity->name ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteActivityNotSuitable' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('activity_not_suitable_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['activity','action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {

        $saved_obj = $this->model_activity_not_suitable->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity_not_suitable = $this->model_activity_not_suitable->getModel()::find($id);

        if (!$activity_not_suitable)
            return false;

        return $activity_not_suitable;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity_not_suitable = $this->model_activity_not_suitable->getModel()::find($id);
        $activity_not_suitable->delete();

        if (!$activity_not_suitable)
            return false;

        return true;
    }
}
