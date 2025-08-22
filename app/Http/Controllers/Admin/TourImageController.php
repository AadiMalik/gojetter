<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\TourImageService;
use App\Services\Concrete\TourService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TourImageController extends Controller
{
    use ResponseAPI;
    protected $tour_image_service;
    protected $tour_service;

    public function __construct(
        TourImageService $tour_image_service,
        TourService $tour_service
    ) {
        $this->tour_image_service = $tour_image_service;
        $this->tour_service = $tour_service;
    }

    public function index($tour_id)
    {
        abort_if(Gate::denies('tour_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tour = $this->tour_service->getById($tour_id);
        return view('tour_image.index', compact('tour'));
    }

    public function getData(Request $request)
    {
        abort_if(Gate::denies('tour_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->tour_image_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        abort_if(Gate::denies('tour_image_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'tour_id' => 'required',
                'name' => 'required|string|max:255',
                'image' => 'nullable|image'
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

            if ($request->hasFile('image')) {
                $obj['image'] = $request->file('image')->store('tours', 'public');
            }

            $response = $this->tour_image_service->save($obj);

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
        abort_if(Gate::denies('tour_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $tour_image = $this->tour_image_service->deleteById($id);
            return $this->success(
                $tour_image,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
