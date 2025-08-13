<?php

namespace App\Services\Concrete;

use App\Models\Tour;
use App\Models\TourDate;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TourService
{
    protected $model_tour;
    protected $model_tour_date;
    public function __construct()
    {
        // set the model
        $this->model_tour = new Repository(new Tour);
        $this->model_tour_date = new Repository(new TourDate);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_tour->getModel()::with('tour_category')->where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('category', function ($item) {

                return $item->tour_category->name ?? '';
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
                $additional_column = '';

                $edit_column = "<a class='mr-2 btn-sm btn btn-success' href='tours/edit/" . $item->id . "'><i class='fa fa-edit mr-1'></i> Edit</a>";
                $view_column = "<a class='mr-2 btn-sm btn btn-warning' href='tours/view/" . $item->id . "'><i class='fa fa-eye mr-1'></i> View</a>";
                $delete_column = "<a class='mr-2 btn-sm btn btn-danger' href='javascript:void(0)' id='deleteTour' data-id='" . $item->id . "'><i class='fa fa-trash mr-1'></i> Delete</a>";
                $additional = "<a class='dropdown-item  text-dark' style='padding: 1px 10px;' href='tour-additional/" . $item->id . "'><i class='fa fa-plus mr-1'></i> Additional</a>";
                $dates = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='tour-date/" . $item->id . "'><i class='fa fa-calendar mr-1'></i> Dates</a>";
                $itinerary = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='tour-itinerary/" . $item->id . "'><i class='fa fa-calendar mr-1'></i> Itinerary</a>";
                $inclusion = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='tour-inclusion/" . $item->id . "'><i class='fa fa-check mr-1'></i> Inclusion</a>";
                $exclusion = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='tour-exclusion/" . $item->id . "'><i class='fa fa-close mr-1'></i> Exclusion</a>";
                $faqs = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='tour-faq/" . $item->id . "'><i class='fa fa-question-circle mr-1'></i> FAQs</a>";
                $image = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='tour-image/" . $item->id . "'><i class='fa fa-image mr-1'></i> Gallery</a>";
                $download = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='tour-download/" . $item->id . "'><i class='fa fa-download mr-1'></i> Downloads</a>";
                // if (Auth::user()->can('tour_edit'))
                $action_column .= $edit_column;
                // if (Auth::user()->can('tour_view'))
                $action_column .= $view_column;
                // if (Auth::user()->can('tour_delete'))
                $action_column .= $delete_column;

                // if (Auth::user()->can('tour_date_access'))
                $additional_column .= $dates;
                // if (Auth::user()->can('tour_itinerary_access'))
                $additional_column .= $itinerary;
                // if (Auth::user()->can('tour_inclusion_access'))
                $additional_column .= $inclusion;
                // if (Auth::user()->can('tour_exclusion_access'))
                $additional_column .= $exclusion;
                // if (Auth::user()->can('tour_faqs_access'))
                $additional_column .= $faqs;
                // if (Auth::user()->can('tour_image_access'))
                $additional_column .= $image;
                // if (Auth::user()->can('tour_download_access'))
                $additional_column .= $download;
                // Main button with dropdown    
                $dropdown = '
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-dark dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">
                            Other
                        </button>
                        <div class="dropdown-menu">
                            ' . $additional_column . '
                        </div>
                    </div>
                ';

                return $action_column . $dropdown;
            })
            ->rawColumns(['category', 'is_active', 'action'])
            ->make(true);
        return $data;
    }
    // get all
    public function getAll()
    {
        return $this->model_tour->getModel()::where('is_deleted', 0)->get();
    }
    // save
    public function save($obj)
    {

        if ($obj['id'] != null && $obj['id'] != '') {
            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_tour->update($obj, $obj['id']);
            $saved_obj = $this->model_tour->find($obj['id']);
        } else {
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_tour->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $tour = $this->model_tour->getModel()::with([
            'tour_category',
            'tourImage',
            'tourDate',
            'tourDownload',
            'tourExclusion',
            'tourFaq',
            'tourInclusion',
            'tourItinerary',
            'tourReviews'
        ])->find($id);


        if (!$tour)
            return false;

        return $tour;
    }
    public function statusById($id)
    {
        $tour = $this->model_tour->getModel()::find($id);
        if ($tour->is_active == 1) {
            $tour->is_active = 0;
        } else {

            $tour->is_active = 1;
        }
        $tour->update();
        if (!$tour)
            return false;

        return $tour;
    }

    // delete by id
    public function deleteById($id)
    {
        $tour = $this->model_tour->getModel()::find($id);
        $tour->is_deleted = 1;
        $tour->deletedby_id = Auth::user()->id;
        $tour->date_deleted = Carbon::now();
        $tour->update();

        if (!$tour)
            return false;

        return $tour;
    }

    //tour date
    public function getSourceTourDate()
    {
        $model = $this->model_tour_date->getModel()::with('tour')->where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('price_type', function ($item) {

                return ($item->price_type == 'per_person') ? 'Per Person' : 'Per Group';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteTourDate' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('tour_date_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['price_type', 'action'])
            ->make(true);
        return $data;
    }

    // save tour date
    public function saveTourDate($obj)
    {

        $obj['createdby_id'] = Auth::User()->id;
        $saved_obj = $this->model_tour_date->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // delete tour date by id
    public function deleteTourDateById($id)
    {
        $tour_date = $this->model_tour_date->getModel()::find($id);
        $tour_date->is_deleted = 1;
        $tour_date->deletedby_id = Auth::user()->id;
        $tour_date->date_deleted = Carbon::now();
        $tour_date->update();

        if (!$tour_date)
            return false;

        return $tour_date;
    }

    ////////////////////////
    //tour itinerary
    public function getSourceTourItinerary()
    {
        $model = $this->model_tour_date->getModel()::with('tour');
        $data = DataTables::of($model)
            ->addColumn('image', function ($item) {
                $imageUrl = asset('storage/app/public/' . $item->image); // Correct path
                return '<img src="' . $imageUrl . '" style="width:100px;" />';
            })
            ->addColumn('action', function ($item) {
                $action_column = '';
                $delete_column    = "<a class='text-danger mr-2' id='deleteTourItinerary' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('tour_itinerary_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['price_type', 'action'])
            ->make(true);
        return $data;
    }

    // save tour itinerary
    public function saveTourItinerary($obj)
    {
        $saved_obj = $this->model_tour_date->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // delete tour itinerary by id
    public function deleteTourItineraryById($id)
    {
        $tour_itinerary = $this->model_tour_date->getModel()::find($id);
        $tour_itinerary->delete();

        if (!$tour_itinerary)
            return false;

        return $tour_itinerary;
    }

    //tour list for api
    public function listActiveTours($data)
    {
        $query = Tour::select('tours.*')
            ->with([
                'tour_category',
                'tourImage',
                'tourDate',
                'tourDownload',
                'tourExclusion',
                'tourFaq',
                'tourInclusion',
                'tourItinerary',
                'tourReviews'
            ])
            ->withAvg(['tourReviews as average_rating' => function ($q) {
                $q->where('is_active', 1)->where('is_deleted', 0);
            }], 'rating')
            ->where('is_active', 1)
            ->where('is_deleted', 0);

        // Filter by type
        if (!empty($data['type'])) {
            $query->where('tour_type', $data['type']);
        }
        // Filter by type
        if (!empty($data['category_id'])) {
            $query->where('tour_category_id', $data['category_id']);
        }
        // Filter by location
        if (!empty($data['location'])) {
            $query->where('location', 'LIKE', '%' . $data['location'] . '%');
        }
        if (!empty($data['type'])) {
            $query->where('tour_type', $data['type']);
        }

        if (!empty($data['duration'])) {
            $query->where(function ($q) use ($data) {
                $q->whereRaw("
                    CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED) 
                    BETWEEN ? AND ?
                ", match ($data['duration']) {
                    '1-3' => [1, 3],
                    '4-7' => [4, 7],
                    '8-14' => [8, 14],
                    '15+' => [15, 1000], // arbitrarily large number
                    default => [0, 1000],
                });
            });
        }

        if(!empty($data['search'])){
            $query->where('title', 'LIKE', '%' . $data['search'] . '%')
            ->orWhere('overview', 'LIKE', '%' . $data['search'] . '%')
            ->orWhere('highlights', 'LIKE', '%' . $data['search'] . '%')
            ->orWhere('short_description', 'LIKE', '%' . $data['search'] . '%')
            ->orWhere('full_description', 'LIKE', '%' . $data['search'] . '%');
        }

        $tours = $query->get();

        if (!empty($data['sort_by'])) {
            if ($data['sort_by'] == 'price_low_high') {
                return $tours->sortBy(function ($tour) {
                    return $tour->tourDate->min('price'); // lowest price in the dates
                })->values();
            } elseif ($data['sort_by'] == 'price_high_low') {
                return $tours->sortByDesc(function ($tour) {
                    return $tour->tourDate->min('price'); // lowest price in the dates
                })->values();
            }
        } else {
            $tours = $tours->sortByDesc('title')->values(); // Default sorting
        }

        return $tours;
    }

    //get tour detail
    public function tourDetailById($slug)
    {
        $tour = Tour::with([
            'tour_category',
            'tourReviews' => function ($query) {
                $query->where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->select('id', 'user_id', 'tour_id', 'rating', 'comment', 'created_at');
            },
            'tourImage' => function ($query) {
                $query->select('id', 'tour_id', 'name', 'image');
            },
            'tourDate',
            'tourDownload',
            'tourExclusion',
            'tourFaq',
            'tourInclusion',
            'tourItinerary'
        ])
            ->withAvg(['tourReviews as average_rating' => function ($query) {
                $query->where('is_active', 1)->where('is_deleted', 0);
            }], 'rating')
            ->where('slug', $slug)
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->first();

        return $tour;
    }
}
