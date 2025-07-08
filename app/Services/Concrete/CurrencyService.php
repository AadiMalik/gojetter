<?php

namespace App\Services\Concrete;

use App\Models\Currency;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CurrencyService
{
      protected $model_currency;
      public function __construct()
      {
            // set the model
            $this->model_currency = new Repository(new Currency);
      }
      //Bead type
      public function getSource()
      {
            $model = $this->model_currency->getModel()::where('is_deleted', 0);
            $data = DataTables::of($model)
                  ->addColumn('is_default', function ($item) {
                        if ($item->is_default == 1) {
                              $default = '<label class="switch pr-5 switch-primary mr-3"><input type="checkbox" checked="checked" id="default" data-id="' . $item->id . '"><span class="slider"></span></label>';
                        } else {
                              $default = '<label class="switch pr-5 switch-primary mr-3"><input type="checkbox" id="default" data-id="' . $item->id . '"><span class="slider"></span></label>';
                        }
                        return $default;
                  })
                  ->addColumn('action', function ($item) {
                        $action_column = '';
                        $edit_column    = "<a class='text-success mr-2' id='editCurrency' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='Edit'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                        $delete_column    = "<a class='text-danger mr-2' id='deleteCurrency' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                        // if (Auth::user()->can('currency_edit'))
                        $action_column .= $edit_column;
                        // if (Auth::user()->can('currency_delete'))
                        $action_column .= $delete_column;

                        return $action_column;
                  })
                  ->rawColumns(['is_default', 'action'])
                  ->make(true);
            return $data;
      }
      // get all
      public function getAll()
      {
            return $this->model_currency->getModel()::where('is_deleted', 0)->get();
      }
      // save
      public function save($obj)
      {

            $obj['createdby_id'] = Auth::User()->id;

            $saved_obj = $this->model_currency->create($obj);

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // update
      public function update($obj)
      {

            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_currency->update($obj, $obj['id']);
            $saved_obj = $this->model_currency->find($obj['id']);

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get by id
      public function getById($id)
      {
            $currency = $this->model_currency->getModel()::find($id);

            if (!$currency)
                  return false;

            return $currency;
      }
      public function defaultById($id)
      {
            $currency = $this->model_currency->getModel()::find($id);

            if (!$currency) {
                  return false;
            }

            $this->model_currency->getModel()::where('is_default', 1)->update(['is_default' => 0]);

            $currency->is_default = 1;

            $currency->updatedby_id = Auth::user()->id;
            $currency->update();

            return true;
      }

      // delete by id
      public function deleteById($id)
      {
            $currency = $this->model_currency->getModel()::find($id);
            $currency->is_deleted = 1;
            $currency->deletedby_id = Auth::user()->id;
            $currency->date_deleted = Carbon::now();
            $currency->update();

            if (!$currency)
                  return false;

            return $currency;
      }
}
