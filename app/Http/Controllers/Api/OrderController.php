<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Services\Concrete\Api\OrderService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ResponseAPI;
    protected $order_service;

    public function __construct(
        OrderService $order_service
    ) {
        $this->order_service = $order_service;
    }

    public function index()
    {
        $orders = $this->order_service->list();
        return $this->success(
            $orders,
            ResponseMessage::FETCHED
        );
    }

    public function store(StoreOrderRequest $request)
    {
        $obj = $request->validated();
        $order = $this->order_service->save($obj);
        if ($order=='true') {
            return $this->success(
                $order,
                ResponseMessage::SAVE
            );
        } else {
            return $this->error($order);
        }
    }

    public function getOrderDetail($id)
    {
        $order = $this->order_service->getById($id);
        return $this->success(
            $order,
            ResponseMessage::FETCHED_DETAIL
        );
    }
}
