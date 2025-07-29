<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'name',
        'slug',
        'image',
        'description',
        'has_customer_form',
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

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/app/public/' .  $this->image);
        }

        return null;
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
