<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'start_date',
        'end_date',
        'price',
        'discount_price',
        'price_type',
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
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
