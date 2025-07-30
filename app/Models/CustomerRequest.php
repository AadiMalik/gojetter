<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_service_id',
        'name',
        'email',
        'phone',
        'country',
        'city',
        'age',
        'medical_history',
        'gender',
        'file',
        'specific_date',

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

    public function sub_service()
    {
        return $this->belongsTo(SubService::class, 'sub_service_id');
    }
}
