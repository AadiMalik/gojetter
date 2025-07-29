<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'has_contact_form',
        'is_active',
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
}
