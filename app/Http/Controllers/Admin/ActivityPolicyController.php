<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ActivityPolicyService;
use App\Services\Concrete\ActivityService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivityPolicyController extends Controller
{
    use ResponseAPI;
    protected $activity_policy_service;
    protected $activity_service;

    public function __construct(
        ActivityPolicyService $activity_policy_service,
        ActivityService $activity_service
    ) {
        $this->activity_policy_service = $activity_policy_service;
        $this->activity_service = $activity_service;
    }

    public function index($activity_id)
    {
        abort_if(Gate::denies('activity_policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity = $this->activity_service->getById($activity_id);
        return view('activity_policy.index', compact('activity'));
    }

    public function getData(Request $request)
    {
        abort_if(Gate::denies('activity_policy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->activity_policy_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        abort_if(Gate::denies('activity_policy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'activity_id' => 'required',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
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
            $response = $this->activity_policy_service->save($obj);

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
        abort_if(Gate::denies('activity_policy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity_policy = $this->activity_policy_service->deleteById($id);
            return $this->success(
                $activity_policy,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
