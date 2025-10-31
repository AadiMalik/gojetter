<?php

namespace App\Services\Concrete\Api;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\Testimonial;
use App\Repository\Repository;
use App\Services\Concrete\ActivityService;
use App\Services\Concrete\TourService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeService
{
    protected $model_activity;
    protected $model_tour;
    protected $model_testimonial;
    protected $model_destination;
    protected $activity_service;
    protected $tour_service;
    public function __construct()
    {
        // set the model
        $this->model_activity = new Repository(new Activity());
        $this->model_tour = new Repository(new Tour());
        $this->model_testimonial = new Repository(new Testimonial());
        $this->model_destination = new Repository(new Destination());

        $this->activity_service = new ActivityService();
        $this->tour_service = new TourService();
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

    // api data
    public function apiData($data)
    {
        $salesSub = DB::table('order_details')
            ->select('activity_id', DB::raw('COUNT(*) as total_sales'))
            ->where('is_deleted', 0)
            ->groupBy('activity_id');

        $top_activities = $this->model_activity->getModel()::select('activities.*', DB::raw('COALESCE(sales.total_sales, 0) as total_sales'))
            ->leftJoinSub($salesSub, 'sales', function ($join) {
                $join->on('activities.id', '=', 'sales.activity_id');
            })
            ->where('activities.is_active', 1)
            ->where('activities.is_deleted', 0)
            ->orderByDesc('total_sales')
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
            ->take(6)
            ->get();
        if ($top_activities->count() < 6) {
            $needed = 6 - $top_activities->count();

            // Step 3: Fetch random remaining
            $random_activities = $this->model_activity->getModel()::where('is_active', 1)
                ->where('is_deleted', 0)
                ->where('is_featured', 1)
                ->whereNotIn('id', $top_activities->pluck('id')) // avoid duplicates
                ->inRandomOrder()
                ->take($needed)
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
                ->get();

            // Step 4: Merge both collections
            $top_activities = $top_activities->merge($random_activities);
        }
        foreach ($top_activities as $item) {
            if (!empty($data['user_id']) && $data['user_id'] != '') {
                $item['is_wishlist'] = $this->activity_service->isActivityWishlist($item->id, $data['user_id']);
            } else {
                $item['is_wishlist'] = 0;
            }
        }
        $discount_tours = $this->model_tour->getModel()::select('tours.*')
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
            ->where('tours.is_active', 1)
            ->where('tours.is_deleted', 0)
            ->whereHas('tourDate', function ($q) {
                $q->whereNotNull('discount_price')
                    ->where('discount_price', '>', 0);
            })
            ->inRandomOrder()
            ->get();

        foreach ($discount_tours as $item) {
            if (!empty($data['user_id']) && $data['user_id'] != '') {
                $item['is_wishlist'] = $this->tour_service->isTourWishlist($item->id, $data['user_id']);
            } else {
                $item['is_wishlist'] = 0;
            }
        }


        //distinations
        $destinations = $this->model_destination->getModel()::where('is_deleted', 0)->where('is_active', 1)->get();
        $discount_destination = [];
        foreach ($destinations as $item) {
            $discount_destination[] = [
                "destination_id" => $item->id,
                "destination_name" => $item->name ?? '',
                "is_active" => $item->is_active ?? '',
                "tours" => $discount_tours->where('destination_id', $item->id)->values()
            ];
        }
        return [
            "top_selling_activities" => $top_activities,
            "discount_tours" => $discount_tours,
            'discount_destinations' => $discount_destination
        ];
    }
}
