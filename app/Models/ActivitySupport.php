<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySupport extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'contact_type',
        'contact_info'
    ];
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
