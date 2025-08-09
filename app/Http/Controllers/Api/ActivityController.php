<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetActivityListRequest;
use App\Http\Requests\Api\StoreActivityReviewRequest;
use App\Services\Concrete\ActivityReviewService;
use App\Services\Concrete\ActivityService;
use App\Traits\ResponseAPI;

class ActivityController extends Controller
{
    use ResponseAPI;
    protected $activity_service;
    protected $activity_review_service;

    public function __construct(
        ActivityService $activity_service,
        ActivityReviewService $activity_review_service
    ) {
        $this->activity_service = $activity_service;
        $this->activity_review_service = $activity_review_service;
    }

    //activity list
    public function activityList(GetActivityListRequest $request){
        $activities = $this->activity_service->listActiveActivities($request->validated());
        return $this->success(
            $activities,
            ResponseMessage::FETCHED
        );
    }

    //activity by slug
    public function activityBySlug($slug){
        $activity = $this->activity_service->activityDetailById($slug);
        return $this->success(
            $activity,
            ResponseMessage::FETCHED
        );
    }

    //add review
    public function storeReiew(StoreActivityReviewRequest $request){
        $activity_review = $this->activity_review_service->save($request->validated());
        return $this->success(
            $activity_review,
            ResponseMessage::SAVE
        );

    }
}

