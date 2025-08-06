<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\TourDateService;
use App\Services\Concrete\TourService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourDateController extends Controller
{
    use ResponseAPI;
    protected $tour_date_service;
    protected $tour_service;

    public function __construct(
        TourDateService $tour_date_service,
        TourService $tour_service
    ) {
        $this->tour_date_service = $tour_date_service;
        $this->tour_service = $tour_service;
    }

    public function index($tour_id)
    {
        // abort_if(Gate::denies('tour_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour = $this->tour_service->getById($tour_id);
        return view('tour_date.index', compact('tour'));
    }

    public function getData(Request $request)
    {
        // abort_if(Gate::denies('tour_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->tour_date_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        // abort_if(Gate::denies('tour_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'tour_id' => 'required',
                'start_date' => 'required|date|before:end_date',
                'end_date' => 'required|date|after:start_date',
                'price_type' => 'nullable|in:per_person,per_group',
                'price' => 'required|min:1',
                'discount_price' => 'required|min:0',
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

            $response = $this->tour_date_service->save($obj);

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
        // abort_if(Gate::denies('tour_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_date = $this->tour_date_service->deleteById($id);
            return $this->success(
                $tour_date,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
