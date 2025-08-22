<?php

namespace App\Services\Concrete;

use App\Models\TourExclusion;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourExclusionService
{
    protected $model_tour_exclusion;
    public function __construct()
    {
        // set the model
        $this->model_tour_exclusion = new Repository(new TourExclusion);
    }
    //Bead type
    public function getSource($data)
    {
        $model = $this->model_tour_exclusion->getModel()::with('tour')
        ->where('tour_id', $data['tour_id']);
        $data = DataTables::of($model)
            ->addColumn('tour', function ($item) {

                return $item->tour->name ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteTourExclusion' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('tour_exclusion_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['tour','action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {

        $saved_obj = $this->model_tour_exclusion->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $tour_exclusion = $this->model_tour_exclusion->getModel()::find($id);

        if (!$tour_exclusion)
            return false;

        return $tour_exclusion;
    }

    // delete by id
    public function deleteById($id)
    {
        $tour_exclusion = $this->model_tour_exclusion->getModel()::find($id);
        $tour_exclusion->delete();

        if (!$tour_exclusion)
            return false;

        return true;
    }
}
