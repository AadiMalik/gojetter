<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\TourService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{
    use ResponseAPI;
    protected $tour_service;

    public function __construct(TourService $tour_service)
    {
        $this->tour_service = $tour_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('tour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tour.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('tour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->tour_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('tour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('tour.create');
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('tour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
                'symbol' => 'required',
                'rate' => 'required',
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
            $obj = [
                'id' => $request->id,
                'code' => $request->code,
                'symbol' => $request->symbol,
                'rate' => $request->rate,
            ];
            $response = $this->tour_service->save($obj);
            return  $this->success(
                $response,
                ResponseMessage::SAVE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('tour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour = $this->tour_service->getById($id);
        return view('tour.create', compact('tour'));
    }

    public function status($id)
    {
        // abort_if(Gate::denies('tour_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour = $this->tour_service->statusById($id);
            return $this->success(
                $tour,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('tour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour = $this->tour_service->deleteById($id);
            return $this->success(
                $tour,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
