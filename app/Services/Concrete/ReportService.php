<?php

namespace App\Services\Concrete;

use App\Models\Booking;
use App\Models\Order;
use App\Models\User;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportService
{
    protected $model_user;
    protected $model_booking;
    protected $model_order;
    public function __construct()
    {
        // set the model
        $this->model_user = new Repository(new User());
        $this->model_booking = new Repository(new Booking());
        $this->model_order = new Repository(new Order());
    }
    public function getCustomerReport($data)
    {
        $wh = [];
        $wh[] = ['is_deleted', 0];
        $customer = $this->model_user->getModel()::select(
            'id',
            'username',
            'name',
            'email',
            'phone',
            'gender',
            'city',
            'state',
            'zip_code'
        )
            ->with(['roles', 'country'])
            ->whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })
            ->where($wh)
            ->where('created_at', '>=', $data['start_date'] . ' 00:00:00')
            ->where('created_at', '<=', $data['end_date'] . ' 23:59:59')
            ->get();
        return $customer;
    }

    //booking report
    public function getBookingReport($data)
    {
        $wh = [];
        $wh[] = ['is_deleted', 0];
        if ($data['status'] != '' && $data['status'] != null) {
            $wh[] = ['status', $data['status']];
        }
        $bookings = $this->model_booking->getModel()::with(['tour', 'user', 'card', 'currency'])
            ->where($wh)
            ->where('created_at', '>=', $data['start_date'] . ' 00:00:00')
            ->where('created_at', '<=', $data['end_date'] . ' 23:59:59')
            ->get();
        return $bookings;
    }

    //booking detail report
    public function getBookingDetailReport($data)
    {
        $wh = [];
        $wh[] = ['is_deleted', 0];
        if ($data['status'] != '' && $data['status'] != null) {
            $wh[] = ['status', $data['status']];
        }
        $bookings = $this->model_booking->getModel()::with([
            'bookingDetail' => function ($q) {
                $q->where('is_deleted', 0);
            },
            'tour',
            'user',
            'card',
            'currency'
        ])
            ->where($wh)
            ->where('created_at', '>=', $data['start_date'] . ' 00:00:00')
            ->where('created_at', '<=', $data['end_date'] . ' 23:59:59')
            ->get();
        return $bookings;
    }

    //order report
    public function getOrderReport($data)
    {
        $wh = [];
        $wh[] = ['is_deleted', 0];
        if ($data['status'] != '' && $data['status'] != null) {
            $wh[] = ['status', $data['status']];
        }
        $orders = $this->model_order->getModel()::with(['tour', 'user', 'card', 'currency'])
            ->where($wh)
            ->where('created_at', '>=', $data['start_date'] . ' 00:00:00')
            ->where('created_at', '<=', $data['end_date'] . ' 23:59:59')
            ->get();
        return $orders;
    }

    //order detail report
    public function getOrderDetailReport($data)
    {
        $wh = [];
        $wh[] = ['is_deleted', 0];
        if ($data['status'] != '' && $data['status'] != null) {
            $wh[] = ['status', $data['status']];
        }
        $orders = $this->model_order->getModel()::with([
            'orderDetail',
            'user',
            'card',
            'currency'
        ])
            ->where($wh)
            ->where('created_at', '>=', $data['start_date'] . ' 00:00:00')
            ->where('created_at', '<=', $data['end_date'] . ' 23:59:59')
            ->get();
        return $orders;
    }
}
