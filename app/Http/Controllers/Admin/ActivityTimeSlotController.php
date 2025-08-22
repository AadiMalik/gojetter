<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ActivityTimeSlotService;
use App\Services\Concrete\ActivityDateService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivityTimeSlotController extends Controller
{
    use ResponseAPI;
    protected $activity_time_slot_service;
    protected $activity_date_service;

    public function __construct(
        ActivityTimeSlotService $activity_time_slot_service,
        ActivityDateService $activity_date_service
    ) {
        $this->activity_time_slot_service = $activity_time_slot_service;
        $this->activity_date_service = $activity_date_service;
    }

    public function index($activity_date_id)
    {
        // abort_if(Gate::denies('activity_time_slot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity_date = $this->activity_date_service->getById($activity_date_id);
        return view('activity_time_slot.index', compact('activity_date'));
    }

    public function getData(Request $request)
    {
        // abort_if(Gate::denies('activity_time_slot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->activity_time_slot_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        // abort_if(Gate::denies('activity_time_slot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            [
                'activity_date_id' => 'required|exists:activity_dates,id',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'total_seats' => 'required|integer|min:1',
            ],
            [
                'end_time.after' => 'The end time must be after the start time.',
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
            $obj['available_seats']=$request->total_seats;
            $response = $this->activity_time_slot_service->save($obj);

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
        // abort_if(Gate::denies('activity_time_slot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity_time_slot = $this->activity_time_slot_service->deleteById($id);
            return $this->success(
                $activity_time_slot,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
