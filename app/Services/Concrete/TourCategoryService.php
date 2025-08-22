<?php

namespace App\Services\Concrete;

use App\Models\TourCategory;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourCategoryService
{
    protected $model_tour_category;
    public function __construct()
    {
        // set the model
        $this->model_tour_category = new Repository(new TourCategory);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_tour_category->getModel()::where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('thumbnail', function ($item) {
                return '<img src="storage/app/public/' . $item->thumbnail . '" style="width:100px;" />';
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
                $edit_column    = "<a class='text-success mr-2' href='tour-category/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteTourCategory' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('tour_category_edit'))
                $action_column .= $edit_column;
                if (Auth::user()->can('tour_category_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['thumbnail','is_active', 'action'])
            ->make(true);
        return $data;
    }
    // get all
    public function getAll()
    {
        return $this->model_tour_category->getModel()::where('is_deleted', 0)->get();
    }
    // get all active
    public function getAllActive()
    {
        return $this->model_tour_category->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
    }
    // save
    public function save($obj)
    {

        if ($obj['id'] != null && $obj['id'] != '') {
            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_tour_category->update($obj, $obj['id']);
            $saved_obj = $this->model_tour_category->find($obj['id']);
        } else {
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_tour_category->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $tour_category = $this->model_tour_category->getModel()::find($id);

        if (!$tour_category)
            return false;

        return $tour_category;
    }
    public function statusById($id)
    {
        $tour_category = $this->model_tour_category->getModel()::find($id);
        if ($tour_category->is_active == 1) {
            $tour_category->is_active = 0;
        } else {

            $tour_category->is_active = 1;
        }
        $tour_category->update();
        if (!$tour_category)
            return false;

        return $tour_category;
    }

    // delete by id
    public function deleteById($id)
    {
        $tour_category = $this->model_tour_category->getModel()::find($id);
        $tour_category->is_deleted = 1;
        $tour_category->deletedby_id = Auth::user()->id;
        $tour_category->date_deleted = Carbon::now();
        $tour_category->update();

        if (!$tour_category)
            return false;

        return $tour_category;
    }
}
