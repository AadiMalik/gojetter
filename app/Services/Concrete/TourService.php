<?php

namespace App\Services\Concrete;

use App\Models\Tour;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourService
{
    protected $model_tour;
    public function __construct()
    {
        // set the model
        $this->model_tour = new Repository(new Tour);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_tour->getModel()::with('tour_category')->where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('category', function ($item) {
                
                return $item->tour_category->name??'';
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
                $edit_column    = "<a class='text-success mr-2' href='tours/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $view_column    = "<a class='text-warning mr-2' href='tours/view/" . $item->id . "'><i title='View' class='nav-icon mr-2 fa fa-eye'></i>View</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteTour' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                $image_column    = "<a class='text-info mr-2' href='tour-image/" . $item->id . "'><i title='View' class='nav-icon mr-2 fa fa-image'></i>Images</a>";
                // if (Auth::user()->can('tour_edit'))
                $action_column .= $edit_column;
                // if (Auth::user()->can('tour_view'))
                $action_column .= $view_column;
                // if (Auth::user()->can('tour_delete'))
                $action_column .= $delete_column;
                // if (Auth::user()->can('tour_image_access'))
                $action_column .= $image_column;

                return $action_column;
            })
            ->rawColumns(['category','is_active', 'action'])
            ->make(true);
        return $data;
    }
    // get all
    public function getAll()
    {
        return $this->model_tour->getModel()::where('is_deleted', 0)->get();
    }
    // save
    public function save($obj)
    {

        if ($obj['id'] != null && $obj['id'] != '') {
            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_tour->update($obj, $obj['id']);
            $saved_obj = $this->model_tour->find($obj['id']);
        } else {
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_tour->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $tour = $this->model_tour->getModel()::find($id);

        if (!$tour)
            return false;

        return $tour;
    }
    public function statusById($id)
    {
        $tour = $this->model_tour->getModel()::find($id);
        if ($tour->is_active == 1) {
            $tour->is_active = 0;
        } else {

            $tour->is_active = 1;
        }
        $tour->update();
        if (!$tour)
            return false;

        return $tour;
    }

    // delete by id
    public function deleteById($id)
    {
        $tour = $this->model_tour->getModel()::find($id);
        $tour->is_deleted = 1;
        $tour->deletedby_id = Auth::user()->id;
        $tour->date_deleted = Carbon::now();
        $tour->update();

        if (!$tour)
            return false;

        return $tour;
    }
}
