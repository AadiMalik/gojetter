<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCartRequest;
use App\Services\Concrete\Api\CartService;
use App\Traits\ResponseAPI;

class CartController extends Controller
{
    use ResponseAPI;
    protected $cart_service;

    public function __construct(CartService $cart_service)
    {
        $this->cart_service = $cart_service;
    }

    public function index()
    {
        $cart = $this->cart_service->getByUserId();
        return $this->success(
            $cart,
            ResponseMessage::FETCHED
        );
    }

    //store
    public function store(StoreCartRequest $request)
    {
        $obj = $request->validated();
        $available = $this->cart_service->checkAvailable($obj);
        if ($available!="true") {
            return $this->error(
                $available
            );
        }
        $cart = $this->cart_service->save($obj);
        return $this->success(
            $cart,
            ResponseMessage::SAVE
        );
    }

    // delete
    public function destroy($cart_id)
    {
        $cart = $this->cart_service->deleteById($cart_id);
        return $this->success(
            $cart,
            ResponseMessage::DELETE
        );
    }
}
