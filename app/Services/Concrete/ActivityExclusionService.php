<?php

namespace App\Services\Concrete;

use App\Models\ActivityExclusion;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityExclusionService
{
    protected $model_activity_exclusion;
    public function __construct()
    {
        // set the model
        $this->model_activity_exclusion = new Repository(new ActivityExclusion());
    }
    
    public function getSource($data)
    {
        $model = $this->model_activity_exclusion->getModel()::with('activity')
        ->where('activity_id', $data['activity_id']);
        $data = DataTables::of($model)
            ->addColumn('activity', function ($item) {

                return $item->activity->name ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteActivityExclusion' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('activity_exclusion_delete'))
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

        $saved_obj = $this->model_activity_exclusion->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity_exclusion = $this->model_activity_exclusion->getModel()::find($id);

        if (!$activity_exclusion)
            return false;

        return $activity_exclusion;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity_exclusion = $this->model_activity_exclusion->getModel()::find($id);
        $activity_exclusion->delete();

        if (!$activity_exclusion)
            return false;

        return true;
    }
}
