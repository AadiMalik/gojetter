<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\TourInclusionService;
use App\Services\Concrete\TourService;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TourInclusionController extends Controller
{
    use ResponseAPI;
    protected $tour_inclusion_service;
    protected $tour_service;

    public function __construct(
        TourInclusionService $tour_inclusion_service,
        TourService $tour_service
    ) {
        $this->tour_inclusion_service = $tour_inclusion_service;
        $this->tour_service = $tour_service;
    }

    public function index($tour_id)
    {
        abort_if(Gate::denies('tour_inclusion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour = $this->tour_service->getById($tour_id);
        return view('tour_inclusion.index', compact('tour'));
    }

    public function getData(Request $request)
    {
        abort_if(Gate::denies('tour_inclusion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->tour_inclusion_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        abort_if(Gate::denies('tour_inclusion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'tour_id' => 'required',
                'item' => 'required|string|max:255',
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
            $response = $this->tour_inclusion_service->save($obj);

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
        abort_if(Gate::denies('tour_inclusion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_inclusion = $this->tour_inclusion_service->deleteById($id);
            return $this->success(
                $tour_inclusion,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
