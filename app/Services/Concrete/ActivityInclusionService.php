<?php

namespace App\Services\Concrete;

use App\Models\ActivityInclusion;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityInclusionService
{
    protected $model_activity_inclusion;
    public function __construct()
    {
        // set the model
        $this->model_activity_inclusion = new Repository(new ActivityInclusion());
    }
    
    public function getSource($data)
    {
        $model = $this->model_activity_inclusion->getModel()::with('activity')
        ->where('activity_id', $data['activity_id']);
        $data = DataTables::of($model)
            ->addColumn('activity', function ($item) {

                return $item->activity->name ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteActivityInclusion' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('activity_inclusion_delete'))
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

        $saved_obj = $this->model_activity_inclusion->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity_inclusion = $this->model_activity_inclusion->getModel()::find($id);

        if (!$activity_inclusion)
            return false;

        return $activity_inclusion;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity_inclusion = $this->model_activity_inclusion->getModel()::find($id);
        $activity_inclusion->delete();

        if (!$activity_inclusion)
            return false;

        return true;
    }
}
