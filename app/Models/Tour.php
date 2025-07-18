<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'tour_category_id',
        'overview',
        'short_description',
        'full_description',
        'duration_days',
        'duration_nights',
        'tour_type',
        'group_size',
        'languages',
        'location',
        'price',
        'min_adults',
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
    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/app/public/' .  $this->thumbnail);
        }

        return null;
    }
    public function tour_category()
    {
        return $this->belongsTo(TourCategory::class, 'tour_category_id');
    }

    public function tourImages() {
        return $this->hasMany(TourImage::class, 'tour_id', 'id');
    }

    public function tourReviews() {
        return $this->hasMany(TourReview::class, 'tour_id', 'id');
    }
}
