<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;
use Exception;
use App\Enums\ResponseMessage;
use App\Services\Concrete\ActivityImageService;
use App\Services\Concrete\ActivityService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivityImageController extends Controller
{
    use ResponseAPI;
    protected $activity_image_service;
    protected $activity_service;

    public function __construct(
        ActivityImageService $activity_image_service,
        ActivityService $activity_service
    ) {
        $this->activity_image_service = $activity_image_service;
        $this->activity_service = $activity_service;
    }

    public function index($activity_id)
    {
        // abort_if(Gate::denies('activity_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity = $this->activity_service->getById($activity_id);
        return view('activity_image.index', compact('activity'));
    }

    public function getData(Request $request)
    {
        // abort_if(Gate::denies('activity_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->activity_image_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        // abort_if(Gate::denies('activity_image_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'activity_id' => 'required',
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
                $obj['image'] = $request->file('image')->store('activity', 'public');
            }

            $response = $this->activity_image_service->save($obj);

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
        // abort_if(Gate::denies('activity_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity_image = $this->activity_image_service->deleteById($id);
            return $this->success(
                $activity_image,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
