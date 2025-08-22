<?php

namespace App\Services\Concrete;

use App\Models\Blog;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BlogService
{
    protected $model_blog;
    public function __construct()
    {
        // set the model
        $this->model_blog = new Repository(new Blog);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_blog->getModel()::with('category')->where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('category', function ($item) {

                return $item->category->name ?? '';
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
                $edit_column    = "<a class='text-success mr-2' href='blogs/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $view_column    = "<a class='text-warning mr-2' href='blogs/view/" . $item->id . "'><i title='View' class='nav-icon mr-2 fa fa-eye'></i>View</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteBlog' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('blog_edit'))
                $action_column .= $edit_column;
                if (Auth::user()->can('blog_view'))
                $action_column .= $view_column;
                if (Auth::user()->can('blog_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['category', 'is_active', 'action'])
            ->make(true);
        return $data;
    }
    // get all
    public function getAll()
    {
        return $this->model_blog->getModel()::where('is_deleted', 0)->get();
    }
    // save
    public function save($obj)
    {

        if ($obj['id'] != null && $obj['id'] != '') {
            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_blog->update($obj, $obj['id']);
            $saved_obj = $this->model_blog->find($obj['id']);
        } else {
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_blog->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $blog = $this->model_blog->getModel()::find($id);

        if (!$blog)
            return false;

        return $blog;
    }
    public function statusById($id)
    {
        $blog = $this->model_blog->getModel()::find($id);
        if ($blog->is_active == 1) {
            $blog->is_active = 0;
        } else {

            $blog->is_active = 1;
        }
        $blog->update();
        if (!$blog)
            return false;

        return $blog;
    }

    // delete by id
    public function deleteById($id)
    {
        $blog = $this->model_blog->getModel()::find($id);
        $blog->is_deleted = 1;
        $blog->deletedby_id = Auth::user()->id;
        $blog->date_deleted = Carbon::now();
        $blog->update();

        if (!$blog)
            return false;

        return $blog;
    }

}
