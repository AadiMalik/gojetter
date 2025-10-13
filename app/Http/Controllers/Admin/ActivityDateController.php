<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ActivityDateService;
use App\Services\Concrete\ActivityService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ActivityDateController extends Controller
{
    use ResponseAPI;
    protected $activity_date_service;
    protected $activity_service;

    public function __construct(
        ActivityDateService $activity_date_service,
        ActivityService $activity_service
    ) {
        $this->activity_date_service = $activity_date_service;
        $this->activity_service = $activity_service;
    }

    public function index($activity_id)
    {
        abort_if(Gate::denies('activity_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activity = $this->activity_service->getById($activity_id);
        return view('activity_date.index', compact('activity'));
    }

    public function getData(Request $request)
    {
        abort_if(Gate::denies('activity_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->activity_date_service->getSource($request->all());
    }
    public function store(Request $request)
    {
        abort_if(Gate::denies('activity_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'activity_id' => 'required',
                'date' => 'required|date',
                'price' => 'required|min:1',
                'discount_price' => 'required|min:0',
                'start_time.*' => 'required|date_format:H:i',
                'end_time.*' => [
                    'required',
                    'date_format:H:i',
                    function ($attribute, $value, $fail) use ($request) {
                        $index = explode('.', $attribute)[1];
                        $start = $request->start_time[$index] ?? null;
                        if ($start && $value <= $start) {
                            $fail('The end time must be after the start time.');
                        }
                    }
                ],
                'total_seats.*' => 'required|integer|min:1',
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

            $response = $this->activity_date_service->save($obj);

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
        abort_if(Gate::denies('activity_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $activity_date = $this->activity_date_service->deleteById($id);
            return $this->success(
                $activity_date,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
