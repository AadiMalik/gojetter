<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermAndCondition extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'createdby_id',
        'updatedby_id'
    ];

    protected $hidden = [
        'createdby_id',
        'updatedby_id',
    ];
}
