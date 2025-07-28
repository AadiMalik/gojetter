<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'name',
        'first_name',
        'last_name',
        'type',
        'dob',
        'weight',
        'weight_unit',

        'is_deleted',
        'createdby_id',
        'updatedby_id',
        'deletedby_id',
        'date_deleted',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'createdby_id',
        'updatedby_id',
        'deletedby_id',
        'is_deleted',
        'date_deleted'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
