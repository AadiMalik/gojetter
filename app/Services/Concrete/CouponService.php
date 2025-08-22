<?php

namespace App\Services\Concrete;

use App\Models\Coupon;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CouponService
{
    protected $model_coupon;
    public function __construct()
    {
        // set the model
        $this->model_coupon = new Repository(new Coupon);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_coupon->getModel()::where('is_deleted', 0);
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
                $edit_column    = "<a class='text-success mr-2' href='coupon/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteCoupon' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('coupon_edit'))
                $action_column .= $edit_column;
                if (Auth::user()->can('coupon_delete'))
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
        return $this->model_coupon->getModel()::where('is_deleted', 0)->get();
    }
    // get all active
    public function getAllActive()
    {
        return $this->model_coupon->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
    }
    // save
    public function save($obj)
    {

        if ($obj['id'] != null && $obj['id'] != '') {
            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_coupon->update($obj, $obj['id']);
            $saved_obj = $this->model_coupon->find($obj['id']);
        } else {
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_coupon->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $coupon = $this->model_coupon->getModel()::find($id);

        if (!$coupon)
            return false;

        return $coupon;
    }
    public function statusById($id)
    {
        $coupon = $this->model_coupon->getModel()::find($id);
        if ($coupon->is_active == 1) {
            $coupon->is_active = 0;
        } else {

            $coupon->is_active = 1;
        }
        $coupon->update();
        if (!$coupon)
            return false;

        return $coupon;
    }

    // delete by id
    public function deleteById($id)
    {
        $coupon = $this->model_coupon->getModel()::find($id);
        $coupon->is_deleted = 1;
        $coupon->deletedby_id = Auth::user()->id;
        $coupon->date_deleted = Carbon::now();
        $coupon->update();

        if (!$coupon)
            return false;

        return $coupon;
    }

    public function applyCoupon($data)
    {

        $coupon = $this->model_coupon->getModel()::select(
            'id',
            'code',
            'type',
            'value',
            'valid_from',
            'valid_until',
            'is_active',
            'created_at'
        )
            ->where('code', $data['code'])
            ->where('is_active', 1)
            ->whereDate('valid_from', '<=', now())
            ->whereDate('valid_until', '>=', now())
            ->first();
        if (!$coupon) {
            return false;
        }

        return $coupon;
    }
}
