<?php

namespace App\Services\Concrete;

use App\Models\TourDate;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourDateService
{
    protected $model_tour_date;
    public function __construct()
    {
        // set the model
        $this->model_tour_date = new Repository(new TourDate);
    }
    //Bead type
    public function getSource($data)
    {
        $model = $this->model_tour_date->getModel()::with('tour')
        ->where('tour_id', $data['tour_id'])
        ->where('is_deleted',0);
        $data = DataTables::of($model)
            ->addColumn('tour', function ($item) {

                return $item->tour->name ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteTourDate' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('tour_date_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['tour', 'action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {

        $obj['createdby_id'] = Auth::User()->id;
        $saved_obj = $this->model_tour_date->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $tour_date = $this->model_tour_date->getModel()::find($id);

        if (!$tour_date)
            return false;

        return $tour_date;
    }

    // delete by id
    public function deleteById($id)
    {
        $tour_date = $this->model_tour_date->getModel()::find($id);
        $tour_date->is_deleted = 1;
        $tour_date->deletedby_id = Auth::user()->id;
        $tour_date->date_deleted = Carbon::now();
        $tour_date->update();

        if (!$tour_date)
            return false;

        return true;
    }
}
