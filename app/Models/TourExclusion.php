<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourExclusion extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'item'
    ];
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
