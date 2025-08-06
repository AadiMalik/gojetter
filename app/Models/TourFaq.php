<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourFaq extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'question',
        'answer'
    ];
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
