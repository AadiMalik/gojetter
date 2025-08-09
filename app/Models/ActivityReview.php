<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'activity_id',
        'rating',
        'comment',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
