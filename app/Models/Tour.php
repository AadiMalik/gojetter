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
        'duration',
        'tour_type',
        'group_size',
        'languages',
        'location',
        'tags',
        'is_featured',
        'highlights',
        'difficulty_level',
        'age_limit',
        'pickup_info',
        'dropoff_info',
        'min_adults',
        'cut_of_day',
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

    public function tourImage() {
        return $this->hasMany(TourImage::class, 'tour_id', 'id');
    }

    public function tourDate() {
        return $this->hasMany(TourDate::class, 'tour_id', 'id');
    }

    public function tourDownload() {
        return $this->hasMany(TourDownload::class, 'tour_id', 'id');
    }

    public function tourExclusion() {
        return $this->hasMany(TourExclusion::class, 'tour_id', 'id');
    }

    public function tourFaq() {
        return $this->hasMany(TourFaq::class, 'tour_id', 'id');
    }

    public function tourInclusion() {
        return $this->hasMany(TourInclusion::class, 'tour_id', 'id');
    }

    public function tourItinerary() {
        return $this->hasMany(TourItinerary::class, 'tour_id', 'id');
    }

    public function tourReviews() {
        return $this->hasMany(TourReview::class, 'tour_id', 'id');
    }
}
