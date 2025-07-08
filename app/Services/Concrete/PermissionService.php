<?php

namespace App\Services\Concrete;

use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionService
{
    // initialize protected model variables
    protected $model_permission;

    public function __construct()
    {
        // set the model
        $this->model_permission = new Repository(new Permission);
    }

    public function getAll(){
        return $this->model_permission->all();
    }

    public function getPermissionSource()
    {
        $model = Permission::get();
        $data = DataTables::of($model)
            ->addColumn('action', function ($item) {
                $action_column = '';
                $edit_column    = "<a class='text-success mr-2' id='editPermission' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='Edit'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";

                // if(Auth::user()->can('permissions_edit'))
                $action_column .= $edit_column;

                return $action_column;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $data;
    }

    public function save($obj)
    {
        if ($obj['id'] != null && $obj['id'] != '') {
            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_permission->update($obj, $obj['id']);
            $saved_obj = $this->model_permission->find($obj['id']);
        } else {
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_permission->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    public function getById($id)
    {
        return $this->model_permission->find($id);
    }
}
