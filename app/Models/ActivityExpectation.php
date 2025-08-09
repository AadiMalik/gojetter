<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityExpectation extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'title',
        'description'
    ];
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
