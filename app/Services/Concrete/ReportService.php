<?php

namespace App\Services\Concrete;

use App\Models\Booking;
use App\Models\User;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportService
{
    protected $model_user;
    protected $model_booking;
    public function __construct()
    {
        // set the model
        $this->model_user = new Repository(new User());
        $this->model_booking = new Repository(new Booking());
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
}
