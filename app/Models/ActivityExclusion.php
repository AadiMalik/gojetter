<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityExclusion extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'item'
    ];
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
