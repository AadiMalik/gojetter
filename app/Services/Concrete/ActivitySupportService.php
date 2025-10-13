<?php

namespace App\Services\Concrete;

use App\Models\ActivitySupport;
use App\Repository\Repository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ActivitySupportService
{
    protected $model_activity_support;
    public function __construct()
    {
        // set the model
        $this->model_activity_support = new Repository(new ActivitySupport());
    }
    
    public function getSource($data)
    {
        $model = $this->model_activity_support->getModel()::with('activity')
        ->where('activity_id', $data['activity_id']);
        $data = DataTables::of($model)
            ->addColumn('activity', function ($item) {

                return $item->activity->name ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteActivitySupport' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
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

        $saved_obj = $this->model_activity_support->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity_policy = $this->model_activity_support->getModel()::find($id);

        if (!$activity_policy)
            return false;

        return $activity_policy;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity_policy = $this->model_activity_support->getModel()::find($id);
        $activity_policy->delete();

        if (!$activity_policy)
            return false;

        return true;
    }
}
