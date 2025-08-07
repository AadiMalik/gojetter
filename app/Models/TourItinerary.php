<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourItinerary extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'day_number',
        'title',
        'description',
        'image'
    ];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/app/public/' .  $this->image);
        }

        return null;
    }
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
