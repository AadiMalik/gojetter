<?php

namespace App\Services\Concrete;

use App\Models\BlogCategory;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BlogCategoryService
{
    protected $model_blog_category;
    public function __construct()
    {
        // set the model
        $this->model_blog_category = new Repository(new BlogCategory);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_blog_category->getModel()::where('is_deleted', 0);
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
                $edit_column    = "<a class='text-success mr-2' id='editBlogCategory' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='Edit'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteBlogCategory' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('blog_category_edit'))
                $action_column .= $edit_column;
                // if (Auth::user()->can('blog_category_delete'))
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
        return $this->model_blog_category->getModel()::where('is_deleted', 0)->get();
    }
    // get all active
    public function getAllActive()
    {
        return $this->model_blog_category->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
    }
    // save
    public function save($obj)
    {

        $obj['createdby_id'] = Auth::User()->id;

        $saved_obj = $this->model_blog_category->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // update
    public function update($obj)
    {

        $obj['updatedby_id'] = Auth::User()->id;
        $this->model_blog_category->update($obj, $obj['id']);
        $saved_obj = $this->model_blog_category->find($obj['id']);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $blog_category = $this->model_blog_category->getModel()::find($id);

        if (!$blog_category)
            return false;

        return $blog_category;
    }
    public function statusById($id)
    {
        $blog_category = $this->model_blog_category->getModel()::find($id);
        if ($blog_category->is_active == 1) {
            $blog_category->is_active = 0;
        } else {

            $blog_category->is_active = 1;
        }
        $blog_category->update();
        if (!$blog_category)
            return false;

        return $blog_category;
    }

    // delete by id
    public function deleteById($id)
    {
        $blog_category = $this->model_blog_category->getModel()::find($id);
        $blog_category->is_deleted = 1;
        $blog_category->deletedby_id = Auth::user()->id;
        $blog_category->date_deleted = Carbon::now();
        $blog_category->update();

        if (!$blog_category)
            return false;

        return $blog_category;
    }
}
