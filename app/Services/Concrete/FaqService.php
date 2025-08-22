<?php

namespace App\Services\Concrete;

use App\Models\Faq;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class FaqService
{
    protected $model_faq;
    public function __construct()
    {
        // set the model
        $this->model_faq = new Repository(new Faq);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_faq->getModel()::where('is_deleted', 0);
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
                $edit_column    = "<a class='text-success mr-2' href='faqs/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteFaq' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('faq_edit'))
                $action_column .= $edit_column;
                if (Auth::user()->can('faq_delete'))
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
        return $this->model_faq->getModel()::where('is_deleted', 0)->get();
    }
    // get all active
    public function getAllActive()
    {
        return $this->model_faq->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
    }
    // save
    public function save($obj)
    {

        if ($obj['id'] != null && $obj['id'] != '') {
            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_faq->update($obj, $obj['id']);
            $saved_obj = $this->model_faq->find($obj['id']);
        } else {
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_faq->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $faq = $this->model_faq->getModel()::find($id);

        if (!$faq)
            return false;

        return $faq;
    }
    public function statusById($id)
    {
        $faq = $this->model_faq->getModel()::find($id);
        if ($faq->is_active == 1) {
            $faq->is_active = 0;
        } else {

            $faq->is_active = 1;
        }
        $faq->update();
        if (!$faq)
            return false;

        return $faq;
    }

    // delete by id
    public function deleteById($id)
    {
        $faq = $this->model_faq->getModel()::find($id);
        $faq->is_deleted = 1;
        $faq->deletedby_id = Auth::user()->id;
        $faq->date_deleted = Carbon::now();
        $faq->update();

        if (!$faq)
            return false;

        return $faq;
    }
}
