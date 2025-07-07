<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'paypal_email',
        'is_show_email_phone',
        'about_yourself',
        'avatar',
        'home_airport',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'created_at',
        'updated_at',
        'is_deleted',
        'date_deleted',
        'deletedby_id'
    ];

    protected $hidden = [
        'createdby_id',
        'updatedby_id',
        'deletedby_id',
        'is_deleted',
        'date_deleted'
    ];
}
