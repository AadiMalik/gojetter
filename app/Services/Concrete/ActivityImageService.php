<?php

namespace App\Services\Concrete;

use App\Models\ActivityImage;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityImageService
{
    protected $model_activity_image;
    public function __construct()
    {
        // set the model
        $this->model_activity_image = new Repository(new ActivityImage);
    }
    //Bead type
    public function getSource($data)
    {
        $model = $this->model_activity_image->getModel()::with('activity')->where('activity_id', $data['activity_id']);
        $data = DataTables::of($model)
            ->addColumn('activity', function ($item) {

                return $item->activity->name ?? '';
            })
            ->addColumn('image', function ($item) {
                $imageUrl = asset('storage/app/public/' . $item->image); // Correct path
                return '<img src="' . $imageUrl . '" style="width:100px;" />';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteActivityImage' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('activity_image_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['activity', 'image', 'action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {

        $saved_obj = $this->model_activity_image->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity_image = $this->model_activity_image->getModel()::find($id);

        if (!$activity_image)
            return false;

        return $activity_image;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity_image = $this->model_activity_image->getModel()::find($id);
        $activity_image->delete();

        if (!$activity_image)
            return false;

        return true;
    }
}
