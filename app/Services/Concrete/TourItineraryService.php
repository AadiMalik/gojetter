<?php

namespace App\Services\Concrete;

use App\Models\TourItinerary;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourItineraryService
{
    protected $model_tour_itinerary;
    public function __construct()
    {
        // set the model
        $this->model_tour_itinerary = new Repository(new TourItinerary);
    }
    //Bead type
    public function getSource($data)
    {
        $model = $this->model_tour_itinerary->getModel()::with('tour')
        ->where('tour_id', $data['tour_id']);
        $data = DataTables::of($model)
            ->addColumn('tour', function ($item) {

                return $item->tour->name ?? '';
            })
            ->addColumn('image', function ($item) {
                $imageUrl = asset('storage/app/public/' . $item->image); // Correct path
                return '<img src="' . $imageUrl . '" style="width:100px;" />';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteTourItinerary' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('tour_itinerary_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['tour', 'image','action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {

        $saved_obj = $this->model_tour_itinerary->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $tour_itinerary = $this->model_tour_itinerary->getModel()::find($id);

        if (!$tour_itinerary)
            return false;

        return $tour_itinerary;
    }

    // delete by id
    public function deleteById($id)
    {
        $tour_itinerary = $this->model_tour_itinerary->getModel()::find($id);
        $tour_itinerary->delete();

        if (!$tour_itinerary)
            return false;

        return true;
    }
}
