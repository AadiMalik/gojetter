<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'date',
        'price',
        'discount_price',
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
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
    public function activityTimeSlot() {
        return $this->hasMany(ActivityTimeSlot::class, 'activity_date_id', 'id')->where('is_deleted',0);
    }
}
