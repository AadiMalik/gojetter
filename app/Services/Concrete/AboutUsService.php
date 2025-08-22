<?php

namespace App\Services\Concrete;

use App\Models\AboutUs;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AboutUsService
{
    protected $model_about_us;
    public function __construct()
    {
        // set the model
        $this->model_about_us = new Repository(new AboutUs);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_about_us->getModel()::query();
        $data = DataTables::of($model)
            ->addColumn('action', function ($item) {
                $action_column = '';
                $edit_column    = "<a class='text-success mr-2' href='about-us/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                if (Auth::user()->can('about_us_edit'))
                $action_column .= $edit_column;

                return $action_column;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $data;
    }
    // get all
    public function getAll()
    {
        return $this->model_about_us->getModel()::get();
    }
    // update
    public function update($obj)
    {

        $obj['updatedby_id'] = Auth::User()->id;
        $this->model_about_us->update($obj, $obj['id']);
        $saved_obj = $this->model_about_us->find($obj['id']);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $about_us = $this->model_about_us->getModel()::find($id);

        if (!$about_us)
            return false;

        return $about_us;
    }

    public function getLatest()
    {
        return $this->model_about_us->getModel()::orderBy('created_at','DESC')->first();
    }

}
