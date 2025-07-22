<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\CouponService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    use ResponseAPI;
    protected $coupon_service;

    public function __construct(CouponService $coupon_service)
    {
        $this->coupon_service = $coupon_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('coupon.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->coupon_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
    public function create()
    {
        // abort_if(Gate::denies('coupon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('coupon.create');
    }
    public function store(Request $request)
    {

        // abort_if(Gate::denies('coupon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required|string|max:255|unique:coupons,code,'.$request->id,
                'type' => 'required|string|in:amount,percentage',
                'value' => 'required',
                'valid_from' => 'required',
                'valid_until' => 'required',
                
            ],
            $this->validationMessage()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $obj = $request->all();

            $response = $this->coupon_service->save($obj);

            if (!$response) {
                return redirect()->back()->with('error', ResponseMessage::ERROR);
            }

            return redirect('coupon')->with('success', ResponseMessage::SAVE);
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function edit($id)
    {
        // abort_if(Gate::denies('coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $coupon = $this->coupon_service->getById($id);
        return view('coupon.create', compact('coupon'));
    }

    public function status($id)
    {
        // abort_if(Gate::denies('coupon_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $coupon = $this->coupon_service->statusById($id);
            return $this->success(
                $coupon,
                ResponseMessage::STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $coupon = $this->coupon_service->deleteById($id);
            return $this->success(
                $coupon,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
