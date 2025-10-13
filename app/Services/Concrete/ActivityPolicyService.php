<?php

namespace App\Services\Concrete;

use App\Models\ActivityPolicy;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityPolicyService
{
    protected $model_activity_policy;
    public function __construct()
    {
        // set the model
        $this->model_activity_policy = new Repository(new ActivityPolicy());
    }
    
    public function getSource($data)
    {
        $model = $this->model_activity_policy->getModel()::with('activity')
        ->where('activity_id', $data['activity_id']);
        $data = DataTables::of($model)
            ->addColumn('activity', function ($item) {

                return $item->activity->name ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteActivityPolicy' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('activity_policy_delete'))
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

        $saved_obj = $this->model_activity_policy->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity_policy = $this->model_activity_policy->getModel()::find($id);

        if (!$activity_policy)
            return false;

        return $activity_policy;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity_policy = $this->model_activity_policy->getModel()::find($id);
        $activity_policy->delete();

        if (!$activity_policy)
            return false;

        return true;
    }
}
