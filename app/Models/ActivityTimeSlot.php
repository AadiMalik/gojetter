<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTimeSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_date_id',
        'start_time',
        'end_time',
        'total_seats',
        'available_seats',

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
    public function activity_date()
    {
        return $this->belongsTo(ActivityDate::class, 'activity_date_id');
    }

    // Format start_time when getting
    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('h A') : null;
    }

    // Format end_time when getting
    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('h A') : null;
    }
}
