<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetTourListRequest;
use App\Http\Requests\Api\StoreTourReviewRequest;
use App\Services\Concrete\TourCategoryService;
use App\Services\Concrete\TourImageService;
use App\Services\Concrete\TourReviewService;
use App\Services\Concrete\TourService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class TourController extends Controller
{
    use ResponseAPI;
    protected $tour_category_service;
    protected $tour_service;
    protected $tour_image_service;
    protected $tour_review_service;

    public function __construct(
        TourCategoryService $tour_category_service,
        TourService $tour_service,
        TourImageService $tour_image_service,
        TourReviewService $tour_review_service
    ) {
        $this->tour_service = $tour_service;
        $this->tour_category_service = $tour_category_service;
        $this->tour_image_service = $tour_image_service;
        $this->tour_review_service = $tour_review_service;
    }

    //tour category
    public function tourCategory(){
        $tour_category = $this->tour_category_service->getAllActive();
        return $this->success(
            $tour_category,
            ResponseMessage::FETCHED
        );
    }

    //tour list
    public function tourList(GetTourListRequest $request){
        $tours = $this->tour_service->listActiveTours($request->validated());
        return $this->success(
            $tours,
            ResponseMessage::FETCHED
        );
    }

    //tour by slug
    public function tourBySlug($slug,Request $request){
        $tour = $this->tour_service->tourDetailById($slug,$request->all());
        return $this->success(
            $tour,
            ResponseMessage::FETCHED
        );
    }

    //add review
    public function storeReiew(StoreTourReviewRequest $request){
        $tour_review = $this->tour_review_service->save($request->validated());
        return $this->success(
            $tour_review,
            ResponseMessage::SAVE
        );

    }
}
