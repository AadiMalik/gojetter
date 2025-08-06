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
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
