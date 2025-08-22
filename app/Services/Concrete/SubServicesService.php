<?php

namespace App\Services\Concrete;

use App\Models\SubService;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SubServicesService
{
      protected $model_sub_service;
      public function __construct()
      {
            // set the model
            $this->model_sub_service = new Repository(new SubService);
      }
      //Bead type
      public function getSource()
      {
            $model = $this->model_sub_service->getModel()::with('service')->where('is_deleted', 0);
            $data = DataTables::of($model)
                  ->addColumn('service', function ($item) {
                        return $item->service->name;
                  })
                  ->addColumn('has_customer_form', function ($item) {
                        return ($item->has_customer_form == 1) ? 'Yes' : 'No';
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
                        $edit_column    = "<a class='text-success mr-2' href='sub-services/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                        $view_column    = "<a class='text-warning mr-2' href='sub-services/view/" . $item->id . "'><i title='View' class='nav-icon mr-2 fa fa-eye'></i>View</a>";
                        $delete_column    = "<a class='text-danger mr-2' id='deleteSubService' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                        if (Auth::user()->can('sub_service_edit'))
                        $action_column .= $edit_column;
                        if (Auth::user()->can('sub_service_view'))
                        $action_column .= $view_column;
                        if (Auth::user()->can('sub_service_delete'))
                        $action_column .= $delete_column;

                        return $action_column;
                  })
                  ->rawColumns(['service', 'image', 'has_customer_form', 'is_active', 'action'])
                  ->make(true);
            return $data;
      }
      // get all
      public function getActiveAll()
      {
            return $this->model_sub_service->getModel()::with('service')
                  ->where('is_deleted', 0)
                  ->where('is_active', 1)
                  ->get();
      }
      // get by slug
      public function getBySlug($slug)
      {
            $sub_service = $this->model_sub_service->getModel()::with('service')
                  ->where('slug', $slug)
                  ->first();

            if (!$sub_service)
                  return false;

            return $sub_service;
      }
      // save
      public function save($obj)
      {

            if ($obj['id'] != null && $obj['id'] != '') {
                  $obj['updatedby_id'] = Auth::User()->id;
                  $this->model_sub_service->update($obj, $obj['id']);
                  $saved_obj = $this->model_sub_service->find($obj['id']);
            } else {
                  $obj['createdby_id'] = Auth::User()->id;
                  $saved_obj = $this->model_sub_service->create($obj);
            }

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get by id
      public function getById($id)
      {
            $sub_service = $this->model_sub_service->getModel()::with('service')->find($id);

            if (!$sub_service)
                  return false;

            return $sub_service;
      }
      public function statusById($id)
      {
            $sub_service = $this->model_sub_service->getModel()::find($id);
            if ($sub_service->is_active == 1) {
                  $sub_service->is_active = 0;
            } else {

                  $sub_service->is_active = 1;
            }
            $sub_service->update();
            if (!$sub_service)
                  return false;

            return $sub_service;
      }

      // delete by id
      public function deleteById($id)
      {
            $sub_service = $this->model_sub_service->getModel()::find($id);
            $sub_service->is_deleted = 1;
            $sub_service->deletedby_id = Auth::user()->id;
            $sub_service->date_deleted = Carbon::now();
            $sub_service->update();

            if (!$sub_service)
                  return false;

            return $sub_service;
      }
}
