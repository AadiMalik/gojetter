<?php

namespace App\Services\Concrete;

use App\Models\City;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CityService
{
      protected $model_city;
      public function __construct()
      {
            // set the model
            $this->model_city = new Repository(new City);
      }
      //Bead type
      public function getSource()
      {
            $model = $this->model_city->getModel()::with('country')->where('is_deleted', 0);
            $data = DataTables::of($model)
                  ->addColumn('country', function ($item) {
                        return $item->country->name ?? '';
                  })
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
                        $edit_column    = "<a class='text-success mr-2' id='editCity' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='Edit'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                        $delete_column    = "<a class='text-danger mr-2' id='deleteCity' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                        if (Auth::user()->can('city_edit'))
                              $action_column .= $edit_column;
                        if (Auth::user()->can('city_delete'))
                              $action_column .= $delete_column;

                        return $action_column;
                  })
                  ->rawColumns(['country','is_active', 'action'])
                  ->make(true);
            return $data;
      }
      // get all
      public function getAll()
      {
            return $this->model_city->getModel()::where('is_deleted', 0)->get();
      }
      // get all active
      public function getAllActive()
      {
            return $this->model_city->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
      }
      // save
      public function save($obj)
      {

            $obj['createdby_id'] = Auth::User()->id;

            $saved_obj = $this->model_city->create($obj);

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // update
      public function update($obj)
      {

            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_city->update($obj, $obj['id']);
            $saved_obj = $this->model_city->find($obj['id']);

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get cities by country id
      public function getCitiesByCountryId($country_id)
      {
            $city = $this->model_city->getModel()::with('country')->where('country_id', $country_id)->where('is_active', 1)->where('is_deleted', 0)->get();

            if (!$city)
                  return false;

            return $city;
      }

      // get by id
      public function getById($id)
      {
            $city = $this->model_city->getModel()::find($id);

            if (!$city)
                  return false;

            return $city;
      }
      public function statusById($id)
      {
            $city = $this->model_city->getModel()::find($id);
            if ($city->is_active == 1) {
                  $city->is_active = 0;
            } else {

                  $city->is_active = 1;
            }
            $city->update();
            if (!$city)
                  return false;

            return $city;
      }

      // delete by id
      public function deleteById($id)
      {
            $city = $this->model_city->getModel()::find($id);
            $city->is_deleted = 1;
            $city->deletedby_id = Auth::user()->id;
            $city->date_deleted = Carbon::now();
            $city->update();

            if (!$city)
                  return false;

            return $city;
      }
}
