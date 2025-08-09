<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'activity_date_id',
        'activity_time_slot_id',
        'user_id',
        'quatitiy'
    ];
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id')->where('is_deleted', 0);
    }

    public function activity_date()
    {
        return $this->belongsTo(ActivityDate::class, 'activity_date_id')->where('is_deleted', 0);
    }
    public function activity_time_slot()
    {
        return $this->belongsTo(ActivityTimeSlot::class, 'activity_time_slot_id')->where('is_deleted', 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->where('is_deleted', 0);
    }
}
