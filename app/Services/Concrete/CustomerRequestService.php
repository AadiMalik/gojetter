<?php

namespace App\Services\Concrete;

use App\Models\CustomerRequest;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CustomerRequestService
{
      protected $model_customer_request;
      public function __construct()
      {
            // set the model
            $this->model_customer_request = new Repository(new CustomerRequest());
      }
      //Bead type
      public function getSource()
      {
            $model = $this->model_customer_request->getModel()::with('sub_service')->where('is_deleted', 0);
            $data = DataTables::of($model)
                  ->addColumn('sub_service', function ($item) {
                        return $item->sub_service->name ?? '';
                  })
                  ->addColumn('action', function ($item) {
                        $action_column = '';
                        $view_column    = "<a class='text-warning mr-2' href='customer-requests/view/" . $item->id . "'><i title='View' class='nav-icon mr-2 fa fa-eye'></i>View</a>";
                        $delete_column    = "<a class='text-danger mr-2' id='deleteCustomerRequest' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                        // if (Auth::user()->can('customer_request_view'))
                        $action_column .= $view_column;
                        // if (Auth::user()->can('customer_request_delete'))
                        $action_column .= $delete_column;

                        return $action_column;
                  })
                  ->rawColumns(['sub_service', 'action'])
                  ->make(true);
            return $data;
      }
      // save
      public function save($obj)
      {

            $obj['createdby_id'] = (Auth::User()) ? Auth::User()->id : null;
            $saved_obj = $this->model_customer_request->create($obj);

            if (!$saved_obj)
                  return false;

            return $this->getById($saved_obj->id);
      }

      // get by id
      public function getById($id)
      {
            $coupon = $this->model_customer_request->getModel()::with('sub_service')->find($id);

            if (!$coupon)
                  return false;

            return $coupon;
      }

      // delete by id
      public function deleteById($id)
      {
            $coupon = $this->model_customer_request->getModel()::find($id);
            $coupon->is_deleted = 1;
            $coupon->deletedby_id = Auth::user()->id;
            $coupon->date_deleted = Carbon::now();
            $coupon->update();

            if (!$coupon)
                  return false;

            return $coupon;
      }
}
