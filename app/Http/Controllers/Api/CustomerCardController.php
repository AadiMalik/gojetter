<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCustomerCardRequest;
use App\Services\Concrete\Api\CustomerCardService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class CustomerCardController extends Controller
{
    use ResponseAPI;
    protected $customer_card_service;

    public function __construct(CustomerCardService $customer_card_service)
    {
        $this->customer_card_service = $customer_card_service;
    }

    public function index()
    {
        $customer_card = $this->customer_card_service->list();
        return $this->success(
            $customer_card,
            ResponseMessage::FETCHED
        );
    }

    public function store(StoreCustomerCardRequest $request)
    {
        $customer_card = $this->customer_card_service->save($request->validated());
        return $this->success(
            $customer_card,
            ResponseMessage::SAVE
        );
    }
}
