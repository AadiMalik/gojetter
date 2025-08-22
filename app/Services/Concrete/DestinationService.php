<?php

namespace App\Services\Concrete;

use App\Models\Destination;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DestinationService
{
    protected $model_destination;
    public function __construct()
    {
        // set the model
        $this->model_destination = new Repository(new Destination);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_destination->getModel()::where('is_deleted', 0);
        $data = DataTables::of($model)
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
                $edit_column    = "<a class='text-success mr-2' id='editDestination' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='Edit'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteDestination' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('destination_edit'))
                $action_column .= $edit_column;
                if (Auth::user()->can('destination_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['is_active', 'action'])
            ->make(true);
        return $data;
    }
    // get all
    public function getAll()
    {
        return $this->model_destination->getModel()::where('is_deleted', 0)->get();
    }
    // get all active
    public function getAllActive()
    {
        return $this->model_destination->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
    }
    // save
    public function save($obj)
    {

        $obj['createdby_id'] = Auth::User()->id;

        $saved_obj = $this->model_destination->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // update
    public function update($obj)
    {

        $obj['updatedby_id'] = Auth::User()->id;
        $this->model_destination->update($obj, $obj['id']);
        $saved_obj = $this->model_destination->find($obj['id']);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $destination = $this->model_destination->getModel()::find($id);

        if (!$destination)
            return false;

        return $destination;
    }
    public function statusById($id)
    {
        $destination = $this->model_destination->getModel()::find($id);
        if ($destination->is_active == 1) {
            $destination->is_active = 0;
        } else {

            $destination->is_active = 1;
        }
        $destination->update();
        if (!$destination)
            return false;

        return $destination;
    }

    // delete by id
    public function deleteById($id)
    {
        $destination = $this->model_destination->getModel()::find($id);
        $destination->is_deleted = 1;
        $destination->deletedby_id = Auth::user()->id;
        $destination->date_deleted = Carbon::now();
        $destination->update();

        if (!$destination)
            return false;

        return $destination;
    }
}
