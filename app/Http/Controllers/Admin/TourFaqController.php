<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\TourFaqService;
use App\Services\Concrete\TourService;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TourFaqController extends Controller
{
    use ResponseAPI;
    protected $tour_faq_service;
    protected $tour_service;

    public function __construct(
        TourFaqService $tour_faq_service,
        TourService $tour_service
    ) {
        $this->tour_faq_service = $tour_faq_service;
        $this->tour_service = $tour_service;
    }

    public function index($tour_id)
    {
        // abort_if(Gate::denies('tour_faq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour = $this->tour_service->getById($tour_id);
        return view('tour_faq.index', compact('tour'));
    }

    public function getData(Request $request)
    {
        // abort_if(Gate::denies('tour_faq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->tour_faq_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        // abort_if(Gate::denies('tour_faq_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'tour_id' => 'required',
                'question' => 'required|string|max:255',
                'answer' => 'required|string',
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            $validation_error = "";
            foreach ($validation->errors()->all() as $message) {
                $validation_error .= $message;
            }
            return $this->validationResponse(
                $validation_error
            );
        }

        try {
            $obj = $request->all();
            $response = $this->tour_faq_service->save($obj);

            if (!$response) {
                return $this->error(ResponseMessage::ERROR);
            }

            return  $this->success(
                $response,
                ResponseMessage::SAVE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function destroy($id)
    {
        // abort_if(Gate::denies('tour_faq_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_faq = $this->tour_faq_service->deleteById($id);
            return $this->success(
                $tour_faq,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
