<?php

namespace App\Services\Concrete;

use App\Models\Country;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CountryService
{
    protected $model_country;
    public function __construct()
    {
        // set the model
        $this->model_country = new Repository(new Country);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_country->getModel()::where('is_deleted', 0);
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
                $edit_column    = "<a class='text-success mr-2' id='editCountry' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='Edit'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteCountry' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('country_edit'))
                $action_column .= $edit_column;
                // if (Auth::user()->can('country_delete'))
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
        return $this->model_country->getModel()::where('is_deleted', 0)->get();
    }
    // get all active
    public function getAllActive()
    {
        return $this->model_country->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
    }
    // save
    public function save($obj)
    {

        $obj['createdby_id'] = Auth::User()->id;

        $saved_obj = $this->model_country->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // update
    public function update($obj)
    {

        $obj['updatedby_id'] = Auth::User()->id;
        $this->model_country->update($obj, $obj['id']);
        $saved_obj = $this->model_country->find($obj['id']);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $country = $this->model_country->getModel()::find($id);

        if (!$country)
            return false;

        return $country;
    }
    public function statusById($id)
    {
        $country = $this->model_country->getModel()::find($id);
        if ($country->is_active == 1) {
            $country->is_active = 0;
        } else {

            $country->is_active = 1;
        }
        $country->update();
        if (!$country)
            return false;

        return $country;
    }

    // delete by id
    public function deleteById($id)
    {
        $country = $this->model_country->getModel()::find($id);
        $country->is_deleted = 1;
        $country->deletedby_id = Auth::user()->id;
        $country->date_deleted = Carbon::now();
        $country->update();

        if (!$country)
            return false;

        return $country;
    }
}
