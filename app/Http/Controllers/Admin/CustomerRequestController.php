<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\CustomerRequestService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomerRequestController extends Controller
{
    use ResponseAPI;
    protected $customer_request_service;

    public function __construct(CustomerRequestService $customer_request_service)
    {
        $this->customer_request_service = $customer_request_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('customer_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('customer_request.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('customer_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->customer_request_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function view($id)
    {
        // abort_if(Gate::denies('customer_request_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customer_request = $this->customer_request_service->getById($id);
        return view('customer_request.view', compact('customer_request'));
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('customer_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $customer_request = $this->customer_request_service->deleteById($id);
            return $this->success(
                $customer_request,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
