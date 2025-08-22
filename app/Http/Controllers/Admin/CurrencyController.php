<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\CurrencyService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{
    use ResponseAPI;
    protected $currency_service;

    public function __construct(CurrencyService $currency_service)
    {
        $this->currency_service = $currency_service;
    }

    public function index()
    {
        abort_if(Gate::denies('currency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('currency.index');
    }

    public function getData()
    {
        abort_if(Gate::denies('currency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->currency_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function store(Request $request)
    {

        abort_if(Gate::denies('currency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            if (isset($request->id)) {
                $obj = [
                    'id' => $request->id,
                    'code' => $request->code,
                    'symbol' => $request->symbol,
                    'rate' => $request->rate,
                ];
                $response = $this->currency_service->update($obj);
                return  $this->success(
                    $response,
                    ResponseMessage::UPDATE,
                    true
                );
            } else {
                $obj = [
                    'code' => $request->code,
                    'symbol' => $request->symbol,
                    'rate' => $request->rate,
                ];
                $response = $this->currency_service->save($obj);
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
        abort_if(Gate::denies('currency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return  $this->success(
                $this->currency_service->getById($id),
                ResponseMessage::SUCCESS,
                false
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function default($id)
    {
        abort_if(Gate::denies('currency_default'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $currency = $this->currency_service->defaultById($id);
            return $this->success(
                $currency,
                'Currency default updated successfully',
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('currency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $currency = $this->currency_service->deleteById($id);
            return $this->success(
                $currency,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
