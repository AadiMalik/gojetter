<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Concrete\TourReviewService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Enums\ResponseMessage;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TourReviewController extends Controller
{
    use ResponseAPI;
    protected $tour_review_service;

    public function __construct(TourReviewService $tour_review_service)
    {
        $this->tour_review_service = $tour_review_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('tour_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tour_review.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('tour_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->tour_review_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function status($id)
    {
        // abort_if(Gate::denies('tour_review_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_review = $this->tour_review_service->statusById($id);
            return $this->success(
                $tour_review,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('tour_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_review = $this->tour_review_service->deleteById($id);
            return $this->success(
                $tour_review,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
