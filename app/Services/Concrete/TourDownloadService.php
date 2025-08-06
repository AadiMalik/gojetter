<?php

namespace App\Services\Concrete;

use App\Models\TourDownload;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourDownloadService
{
    protected $model_tour_download;
    public function __construct()
    {
        // set the model
        $this->model_tour_download = new Repository(new TourDownload);
    }
    //Bead type
    public function getSource($data)
    {
        $model = $this->model_tour_download->getModel()::with('tour')->where('tour_id', $data['tour_id']);
        $data = DataTables::of($model)
            ->addColumn('tour', function ($item) {

                return $item->tour->name ?? '';
            })
            ->addColumn('file_type', function ($item) {

                return ucfirst($item->file_type ?? '');
            })
            ->addColumn('file_path', function ($item) {
                $fileUrl = asset('storage/app/public/' . $item->file_path);

                switch ($item->file_type) {
                    case 'image':
                        return '<img src="' . $fileUrl . '" style="width:100px;" />';

                    case 'document':
                        return '<a href="' . $fileUrl . '" target="_blank">View Document</a>';

                    case 'audio':
                        return '<audio controls style="width:100px;">
                                    <source src="' . $fileUrl . '" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>';

                    case 'video':
                        return '<video width="160" height="90" controls>
                                    <source src="' . $fileUrl . '" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';

                    default:
                        return '<a href="' . $fileUrl . '" target="_blank">Download File</a>';
                }
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteTourDownload' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('tour_download_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['tour','file_type', 'file_path', 'action'])
            ->make(true);
        return $data;
    }
    // save
    public function save($obj)
    {

        $saved_obj = $this->model_tour_download->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $tour_download = $this->model_tour_download->getModel()::find($id);

        if (!$tour_download)
            return false;

        return $tour_download;
    }

    // delete by id
    public function deleteById($id)
    {
        $tour_download = $this->model_tour_download->getModel()::find($id);
        $tour_download->delete();

        if (!$tour_download)
            return false;

        return true;
    }
}
