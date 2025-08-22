<?php

namespace App\Services\Concrete;

use App\Models\TourFaq;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourFaqService
{
    protected $model_tour_faq;
    public function __construct()
    {
        // set the model
        $this->model_tour_faq = new Repository(new TourFaq);
    }
    //Bead type
    public function getSource($data)
    {
        $model = $this->model_tour_faq->getModel()::with('tour')
        ->where('tour_id', $data['tour_id']);
        $data = DataTables::of($model)
            ->addColumn('tour', function ($item) {

                return $item->tour->name ?? '';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteTourFaq' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                if (Auth::user()->can('tour_faq_delete'))
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

        $saved_obj = $this->model_tour_faq->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $tour_faq = $this->model_tour_faq->getModel()::find($id);

        if (!$tour_faq)
            return false;

        return $tour_faq;
    }

    // delete by id
    public function deleteById($id)
    {
        $tour_faq = $this->model_tour_faq->getModel()::find($id);
        $tour_faq->delete();

        if (!$tour_faq)
            return false;

        return true;
    }
}
