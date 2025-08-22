<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\CountryService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    use ResponseAPI;
    protected $country_service;

    public function __construct(CountryService $country_service)
    {
        $this->country_service = $country_service;
    }

    public function index()
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('country.index');
    }

    public function getData()
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->country_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function store(Request $request)
    {

        abort_if(Gate::denies('country_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
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
            if (isset($request->id)) {
                $obj = [
                    'id' => $request->id,
                    'name' => $request->name,
                ];
                $response = $this->country_service->update($obj);
                return  $this->success(
                    $response,
                    ResponseMessage::UPDATE,
                    true
                );
            } else {
                $obj = [
                    'name' => $request->name,
                ];
                $response = $this->country_service->save($obj);
                return  $this->success(
                    $response,
                    ResponseMessage::SAVE,
                    true
                );
            }
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return  $this->success(
                $this->country_service->getById($id),
                ResponseMessage::SUCCESS,
                false
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function status($id)
    {
        abort_if(Gate::denies('country_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $country = $this->country_service->statusById($id);
            return $this->success(
                $country,
                ResponseMessage::UPDATE_STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $country = $this->country_service->deleteById($id);
            return $this->success(
                $country,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
