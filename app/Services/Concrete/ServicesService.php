<?php

namespace App\Services\Concrete;

use App\Models\Service;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ServicesService
{
      protected $model_service;
      public function __construct()
      {
            // set the model
            $this->model_service = new Repository(new Service);
      }
      //Bead type
      public function getSource()
      {
            $model = $this->model_service->getModel()::where('is_deleted', 0);
            $data = DataTables::of($model)
                  ->addColumn('has_contact_form', function ($item) {
                        return ($item->has_contact_form == 1) ? 'Yes' : 'No';
                  })
                  ->addColumn('image', function ($item) {
                        $imageUrl = asset('storage/app/public/' . $item->image); // Correct path
                        return '<img src="' . $imageUrl . '" style="width:100px;" />';
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
                        $edit_column    = "<a class='text-success mr-2' href='services/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                        $view_column    = "<a class='text-warning mr-2' href='services/view/" . $item->id . "'><i title='View' class='nav-icon mr-2 fa fa-eye'></i>View</a>";
                        $delete_column    = "<a class='text-danger mr-2' id='deleteService' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                        // if (Auth::user()->can('service_edit'))
                        $action_column .= $edit_column;
                        // if (Auth::user()->can('service_view'))
                        $action_column .= $view_column;
                        // if (Auth::user()->can('service_delete'))
                        $action_column .= $delete_column;

                        return $action_column;
                  })
                  ->rawColumns(['image','has_contact_form', 'is_active', 'action'])
                  ->make(true);
            return $data;
      }
      // get all
      public function getAll()
      {
            return $this->model_service->getModel()::where('is_deleted', 0)->get();
      }
      // save
      public function save($obj)
      {

            if ($obj['id'] != null && $obj['id'] != '') {
                  $obj['updatedby_id'] = Auth::User()->id;
                  $this->model_service->update($obj, $obj['id']);
                  $saved_obj = $this->model_service->find($obj['id']);
            } else {
                  $obj['createdby_id'] = Auth::User()->id;
                  $saved_obj = $this->model_service->create($obj);
            }

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get by id
      public function getById($id)
      {
            $service = $this->model_service->getModel()::find($id);

            if (!$service)
                  return false;

            return $service;
      }
      public function statusById($id)
      {
            $service = $this->model_service->getModel()::find($id);
            if ($service->is_active == 1) {
                  $service->is_active = 0;
            } else {

                  $service->is_active = 1;
            }
            $service->update();
            if (!$service)
                  return false;

            return $service;
      }

      // delete by id
      public function deleteById($id)
      {
            $service = $this->model_service->getModel()::find($id);
            $service->is_deleted = 1;
            $service->deletedby_id = Auth::user()->id;
            $service->date_deleted = Carbon::now();
            $service->update();

            if (!$service)
                  return false;

            return $service;
      }
}
