<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\CityService;
use App\Services\Concrete\CountryService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    use ResponseAPI;
    protected $city_service;
    protected $country_service;

    public function __construct(CityService $city_service, CountryService $country_service)
    {
        $this->city_service = $city_service;
        $this->country_service = $country_service;
    }

    public function index()
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $country = $this->country_service->getAllActive();
        return view('city.index',compact('country'));
    }

    public function getData()
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->city_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function store(Request $request)
    {

        abort_if(Gate::denies('city_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'country_id' => 'required',
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
                    'country_id' => $request->country_id,
                ];
                $response = $this->city_service->update($obj);
                return  $this->success(
                    $response,
                    ResponseMessage::UPDATE,
                    true
                );
            } else {
                $obj = [
                    'name' => $request->name,
                    'country_id' => $request->country_id,
                ];
                $response = $this->city_service->save($obj);
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
        abort_if(Gate::denies('city_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return  $this->success(
                $this->city_service->getById($id),
                ResponseMessage::SUCCESS,
                false
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function status($id)
    {
        abort_if(Gate::denies('city_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $city = $this->city_service->statusById($id);
            return $this->success(
                $city,
                ResponseMessage::UPDATE_STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $city = $this->city_service->deleteById($id);
            return $this->success(
                $city,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function cityByCountryId($country_id)
    {
        try {
            return  $this->success(
                $this->city_service->getCitiesByCountryId($country_id),
                ResponseMessage::SUCCESS,
                false
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
