<?php

namespace App\Services\Concrete;

use App\Models\Gallery;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GalleryService
{
    protected $model_gallery;
    public function __construct()
    {
        // set the model
        $this->model_gallery = new Repository(new Gallery);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_gallery->getModel()::query();
        $data = DataTables::of($model)
            ->addColumn('image', function ($item) {
                $imageUrl = asset('storage/app/public/' . $item->image); // Correct path
                return '<img src="' . $imageUrl . '" style="width:100px;" />';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteGallery' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('gallery_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {

        $obj['createdby_id'] = Auth::User()->id;
        $saved_obj = $this->model_gallery->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get all
    public function getAll()
    {
        $gallery = $this->model_gallery->getModel()::get();

        if (!$gallery)
            return false;

        return $gallery;
    }

    // get by id
    public function getById($id)
    {
        $gallery = $this->model_gallery->getModel()::find($id);

        if (!$gallery)
            return false;

        return $gallery;
    }

    // delete by id
    public function deleteById($id)
    {
        $gallery = $this->model_gallery->getModel()::find($id);
        $gallery->delete();

        if (!$gallery)
            return false;

        return true;
    }
}
