<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApplyCouponRequest;
use App\Services\Concrete\CouponService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    use ResponseAPI;
    protected $coupon_service;
    public function __construct(
        CouponService $coupon_service
    ) {
        $this->coupon_service = $coupon_service;
    }

    public function applyCoupon(ApplyCouponRequest $request)
    {
        $data = $request->validated();
        $coupon = $this->coupon_service->applyCoupon($data);
        return $this->success(
            $coupon,
            ResponseMessage::SUCCESS
        );
    }
}
