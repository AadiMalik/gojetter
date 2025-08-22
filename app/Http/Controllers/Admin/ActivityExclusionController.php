<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ActivityExclusionService;
use App\Services\Concrete\ActivityService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivityExclusionController extends Controller
{
    use ResponseAPI;
    protected $activity_exclusion_service;
    protected $activity_service;

    public function __construct(
        ActivityExclusionService $activity_exclusion_service,
        ActivityService $activity_service
    ) {
        $this->activity_exclusion_service = $activity_exclusion_service;
        $this->activity_service = $activity_service;
    }

    public function index($activity_id)
    {
        abort_if(Gate::denies('activity_exclusion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity = $this->activity_service->getById($activity_id);
        return view('activity_exclusion.index', compact('activity'));
    }

    public function getData(Request $request)
    {
        abort_if(Gate::denies('activity_exclusion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->activity_exclusion_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        abort_if(Gate::denies('activity_exclusion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'activity_id' => 'required',
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
            $response = $this->activity_exclusion_service->save($obj);

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
        abort_if(Gate::denies('activity_exclusion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity_exclusion = $this->activity_exclusion_service->deleteById($id);
            return $this->success(
                $activity_exclusion,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
