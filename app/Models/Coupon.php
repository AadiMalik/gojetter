<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'type',
        'value',
        'valid_from',
        'valid_until',
        'is_active',
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
}
