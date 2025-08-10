<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'activity_id',
        'activity_date_id',
        'activity_time_slot_id',
        'quantity',
        'price',
        'total',
        
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
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id')->where('is_deleted', 0);
    }
    
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
}
