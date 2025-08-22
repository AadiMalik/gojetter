<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBookingRequest;
use App\Services\Concrete\BookingService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    use ResponseAPI;
    protected $booking_service;

    public function __construct(BookingService $booking_service)
    {
        $this->booking_service = $booking_service;
    }

    //list
    public function index()
    {
        $booking = $this->booking_service->getBookingByUser();
        return $this->success(
            $booking,
            ResponseMessage::FETCHED
        );
    }

    //store
    public function store(StoreBookingRequest $request)
    {
        $obj = $request->validated();
        $obj['total_participants'] = $request->quantity;
        $obj['user_id'] = Auth::User()->id;
        $obj['booking_date'] = now();
        $booking = $this->booking_service->save($obj);
        if ($booking) {
            return $this->success(
                $booking,
                ResponseMessage::SAVE
            );
        } else {
            return $this->error(ResponseMessage::ERROR);
        }
    }
}
