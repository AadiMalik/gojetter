<?php

namespace App\Services\Concrete\Api;

use App\Models\Activity;
use App\Models\Tour;
use App\Models\Testimonial;
use App\Repository\Repository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeService
{
    protected $model_activity;
    protected $model_tour;
    protected $model_testimonial;
    public function __construct()
    {
        // set the model
        $this->model_activity = new Repository(new Activity());
        $this->model_tour = new Repository(new Tour());
        $this->model_testimonial = new Repository(new Testimonial());
    }
    public function webData()
    {

        $activities =  $this->model_activity->getModel()::select('activities.*')
            ->with([
                'destination',
                'activity_category',
                'activityImage',
                'activityDate',
                'activityDate.activityTimeSlot',
                'activityExpectation',
                'activityExclusion',
                'activityPolicy',
                'activityInclusion',
                'activityReviews',
                'activityNotSuitable'
            ])
            ->withAvg(['activityReviews as average_rating' => function ($q) {
                $q->where('is_active', 1)->where('is_deleted', 0);
            }], 'rating')
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->where('is_deleted', 0)
            ->inRandomOrder()
            ->take(4)->get();

        /////////// tours //////////
        $tours = $this->model_tour->getModel()::select('tours.*')
            ->with([
                'destination',
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
            ->where('is_featured', 1)
            ->where('is_deleted', 0)
            ->inRandomOrder()
            ->take(6)->get();
        $testimonials = $this->model_testimonial->getModel()::inRandomOrder()
            ->take(4)->get();

        return [
            "activities" => $activities,
            "tours" => $tours,
            "testimonials" => $testimonials
        ];
    }
}
