<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'tour_id',
        'createdby_id',
        'updatedby_id'
    ];

    protected $hidden = [
        'createdby_id',
        'updatedby_id'
    ];
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
