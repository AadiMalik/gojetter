<?php

namespace App\Services\Concrete;

use App\Models\Policy;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PolicyService
{
    protected $model_policy;
    public function __construct()
    {
        // set the model
        $this->model_policy = new Repository(new Policy);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_policy->getModel()::query();
        $data = DataTables::of($model)
            ->addColumn('action', function ($item) {
                $action_column = '';
                $edit_column    = "<a class='text-success mr-2' href='policy/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                if (Auth::user()->can('private_policy_edit'))
                $action_column .= $edit_column;

                return $action_column;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $data;
    }
    // get latest
    public function getLatest()
    {
        return $this->model_policy->getModel()::orderBy('created_at','DESC')->first();
    }
    // update
    public function update($obj)
    {

        $obj['updatedby_id'] = Auth::User()->id;
        $this->model_policy->update($obj, $obj['id']);
        $saved_obj = $this->model_policy->find($obj['id']);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $about_us = $this->model_policy->getModel()::find($id);

        if (!$about_us)
            return false;

        return $about_us;
    }

}
