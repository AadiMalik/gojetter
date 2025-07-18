<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreWishlistRequest;
use App\Services\Concrete\Api\WishlistService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use ResponseAPI;
    protected $wishlist_service;

    public function __construct(WishlistService $wishlist_service)
    {
        $this->wishlist_service = $wishlist_service;
    }

    public function index(){
        $wishlist = $this->wishlist_service->getByUserId();
        return $this->success(
            $wishlist,
            ResponseMessage::FETCHED
        );
    }

    //store
    public function store(StoreWishlistRequest $request){
        $wishlist = $this->wishlist_service->save($request->validated());
        return $this->success(
            $wishlist,
            ResponseMessage::SAVE
        );

    }

    // delete
    public function destroy($wishlist_id){
        $wishlist = $this->wishlist_service->deleteById($wishlist_id);
        return $this->success(
            $wishlist,
            ResponseMessage::DELETE
        );
    }
}
