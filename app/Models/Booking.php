<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'user_id',
        'booking_date',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'zipcode',
        'address',
        'adults',
        'children',
        'total_participants',
        'sub_total',
        'tax_percent',
        'tax_amount',
        'discount',
        'total',
        'payment_method',
        'currency',
        'coupon_id',
        'status',
        'createdby_id',
        'updatedby_id',
        'deletedby_id',
        'date_deleted',
        'is_deleted'
    ];

    protected $hidden = [
        'createdby_id',
        'updatedby_id',
        'deletedby_id',
        'is_deleted',
        'date_deleted'
    ];

    public function bookingDetail()
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
