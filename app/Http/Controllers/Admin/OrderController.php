<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\OrderService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ResponseAPI;
    protected $order_service;

    public function __construct(OrderService $order_service)
    {
        $this->order_service = $order_service;
    }

    public function index()
    {
        // abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('order.index');
    }

    public function getData()
    {
        // abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            return $this->order_service->getSource();
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function view($id)
    {
        // abort_if(Gate::denies('order_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $order = $this->order_service->getById($id);
            return view('order.view', compact('order'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', ResponseMessage::ERROR);
        }
    }

    public function status(Request $request)
    {
        // abort_if(Gate::denies('order_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $order = $this->order_service->statusById($request->all());
            return $this->success(
                $order,
                ResponseMessage::UPDATE_STATUS,
                200
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $order = $this->order_service->deleteById($id);
            return $this->success(
                $order,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
