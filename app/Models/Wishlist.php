<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'user_id'
    ];


    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
