<?php

namespace App\Services\Concrete;

use App\Models\Testimonial;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TestimonialService
{
    protected $model_testimonial;
    public function __construct()
    {
        // set the model
        $this->model_testimonial = new Repository(new Testimonial);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_testimonial->getModel()::query();
        $data = DataTables::of($model)
            ->addColumn('image', function ($item) {
                return '<img src="storage/app/public/' . $item->image . '" style="width:100px;" />';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $edit_column    = "<a class='text-success mr-2' href='testimonial/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteTestimonail' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('testimonial_edit'))
                $action_column .= $edit_column;
                // if (Auth::user()->can('testimonial_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
        return $data;
    }
    // get all
    public function getAll()
    {
        return $this->model_testimonial->getModel()::get();
    }
    // save
    public function save($obj)
    {

        if ($obj['id'] != null && $obj['id'] != '') {
            $this->model_testimonial->update($obj, $obj['id']);
            $saved_obj = $this->model_testimonial->find($obj['id']);
        } else {
            $saved_obj = $this->model_testimonial->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $testimonial = $this->model_testimonial->getModel()::find($id);

        if (!$testimonial)
            return false;

        return $testimonial;
    }

    // delete by id
    public function deleteById($id)
    {
        $testimonial = $this->model_testimonial->getModel()::find($id);
        $testimonial->delete();

        if (!$testimonial)
            return false;

        return $testimonial;
    }
}
