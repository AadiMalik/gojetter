<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ActivityReviewService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivityReviewController extends Controller
{
    use ResponseAPI;
    protected $activity_review_service;

    public function __construct(ActivityReviewService $activity_review_service)
    {
        $this->activity_review_service = $activity_review_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('activity_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('activity_review.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('activity_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->activity_review_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function status($id)
    {
        // abort_if(Gate::denies('activity_review_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity_review = $this->activity_review_service->statusById($id);
            return $this->success(
                $activity_review,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('activity_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity_review = $this->activity_review_service->deleteById($id);
            return $this->success(
                $activity_review,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
