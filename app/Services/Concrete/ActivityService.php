<?php

namespace App\Services\Concrete;

use App\Models\Activity;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivityService
{
    protected $model_activity;
    public function __construct()
    {
        // set the model
        $this->model_activity = new Repository(new Activity);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_activity->getModel()::with('activity_category')->where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('category', function ($item) {

                return $item->activity_category->name ?? '';
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

                $edit_column = "<a class='mr-2 btn-sm btn btn-success' href='activity/edit/" . $item->id . "'><i class='fa fa-edit mr-1'></i> Edit</a>";
                $view_column = "<a class='mr-2 btn-sm btn btn-warning' href='activity/view/" . $item->id . "'><i class='fa fa-eye mr-1'></i> View</a>";
                $delete_column = "<a class='mr-2 btn-sm btn btn-danger' href='javascript:void(0)' id='deleteActivity' data-id='" . $item->id . "'><i class='fa fa-trash mr-1'></i> Delete</a>";
                $dates = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='activity-date/" . $item->id . "'><i class='fa fa-calendar mr-1'></i> Dates</a>";
                $inclusion = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='activity-inclusion/" . $item->id . "'><i class='fa fa-check mr-1'></i> Inclusion</a>";
                $exclusion = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='activity-exclusion/" . $item->id . "'><i class='fa fa-close mr-1'></i> Exclusion</a>";
                $expectation = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='activity-expectation/" . $item->id . "'><i class='fa fa-leaf mr-1'></i> Expectation</a>";
                $policy = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='activity-policy/" . $item->id . "'><i class='fa fa-question-circle mr-1'></i> Policies</a>";
                $image = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='activity-image/" . $item->id . "'><i class='fa fa-image mr-1'></i> Gallery</a>";
                $support = "<a class='dropdown-item text-dark' style='padding: 1px 10px;' href='activity-support/" . $item->id . "'><i class='fa fa-users mr-1'></i> Supports</a>";
                // if (Auth::user()->can('activity_edit'))
                $action_column .= $edit_column;
                // if (Auth::user()->can('activity_view'))
                $action_column .= $view_column;
                // if (Auth::user()->can('activity_delete'))
                $action_column .= $delete_column;

                // if (Auth::user()->can('activity_date_access'))
                $additional_column .= $dates;
                // if (Auth::user()->can('activity_inclusion_access'))
                $additional_column .= $inclusion;
                // if (Auth::user()->can('activity_exclusion_access'))
                $additional_column .= $exclusion;
                // if (Auth::user()->can('activity_expectation_access'))
                $additional_column .= $expectation;
                // if (Auth::user()->can('activity_policy_access'))
                $additional_column .= $policy;
                // if (Auth::user()->can('activity_image_access'))
                $additional_column .= $image;
                // if (Auth::user()->can('activity_support_access'))
                $additional_column .= $support;
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
        return $this->model_activity->getModel()::where('is_deleted', 0)->get();
    }
    // save
    public function save($obj)
    {

        if ($obj['id'] != null && $obj['id'] != '') {
            $obj['updatedby_id'] = Auth::User()->id;
            $this->model_activity->update($obj, $obj['id']);
            $saved_obj = $this->model_activity->find($obj['id']);
        } else {
            $obj['createdby_id'] = Auth::User()->id;
            $saved_obj = $this->model_activity->create($obj);
        }

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $activity = $this->model_activity->getModel()::with([
            'activity_category',
            'activityImage',
            'activityDate',
            'activityExpectation',
            'activityExclusion',
            'activityPolicy',
            'activityInclusion',
            'activityReviews'
        ])->find($id);


        if (!$activity)
            return false;

        return $activity;
    }
    public function statusById($id)
    {
        $activity = $this->model_activity->getModel()::find($id);
        if ($activity->is_active == 1) {
            $activity->is_active = 0;
        } else {

            $activity->is_active = 1;
        }
        $activity->update();
        if (!$activity)
            return false;

        return $activity;
    }

    // delete by id
    public function deleteById($id)
    {
        $activity = $this->model_activity->getModel()::find($id);
        $activity->is_deleted = 1;
        $activity->deletedby_id = Auth::user()->id;
        $activity->date_deleted = Carbon::now();
        $activity->update();

        if (!$activity)
            return false;

        return $activity;
    }

    //activity list for api
    public function listActiveActivities($data)
    {
        $query = $this->model_activity->getModel()::select('activities.*')
            ->with([
                'activity_category',
                'activityImage',
                'activityDate',
                'activityDate.activityTimeSlot',
                'activityExpectation',
                'activityExclusion',
                'activityPolicy',
                'activityInclusion',
                'activityReviews'
            ])
            ->withAvg(['activityReviews as average_rating' => function ($q) {
                $q->where('is_active', 1)->where('is_deleted', 0);
            }], 'rating')
            ->where('is_active', 1)
            ->where('is_deleted', 0);

        // Filter by type
        if (!empty($data['type'])) {
            $query->where('activity_type', $data['type']);
        }
        // Filter by category
        if (!empty($data['category_id'])) {
            $query->where('category_id', $data['category_id']);
        }

        $activities = $query->get();

        if (!empty($data['sort_by'])) {
            if ($data['sort_by'] == 'price_low_high') {
                return $activities->sortBy(fn($activity) => optional($activity->activityDate)->price)->values();
            } elseif ($data['sort_by'] == 'price_high_low') {
                return $activities->sortByDesc(fn($activity) => optional($activity->activityDate)->price)->values();
            }
        } else {
            $activities = $activities->sortByDesc('title')->values(); // Default sorting
        }

        return $activities;
    }

    //get activity detail
    public function activityDetailById($slug)
    {
        $activity = $this->model_activity->getModel()::with([
            'activity_category',
            'activityReviews' => function ($query) {
                $query->where('is_active', 1)
                    ->where('is_deleted', 0)
                    ->select('id', 'user_id', 'activity_id', 'rating', 'comment', 'created_at');
            },
            'activityImage' => function ($query) {
                $query->select('id', 'activity_id', 'name', 'image');
            },
            'activityDate',
            'activityDate.activityTimeSlot',
            'activityExpectation',
            'activityExclusion',
            'activityPolicy',
            'activityInclusion'
        ])
            ->withAvg(['activityReviews as average_rating' => function ($query) {
                $query->where('is_active', 1)->where('is_deleted', 0);
            }], 'rating')
            ->where('slug', $slug)
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->first();

        return $activity;
    }
}
