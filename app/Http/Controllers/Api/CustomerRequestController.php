<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCustomerRequestRequest;
use App\Services\Concrete\CustomerRequestService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class CustomerRequestController extends Controller
{
    use ResponseAPI;
    protected $customer_request_service;

    public function __construct(CustomerRequestService $customer_request_service)
    {
        $this->customer_request_service = $customer_request_service;
    }

    public function store(StoreCustomerRequestRequest $request)
    {
        $obj = $request->validated();
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('customer_requests', 'public');
            $obj['file'] = $path;
        }
        $customer_request = $this->customer_request_service->save($obj);
        return $this->success(
            $customer_request,
            ResponseMessage::SAVE
        );
    }
}
