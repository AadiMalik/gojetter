<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'destination_id',
        'thumbnail',
        'category_id',
        'overview',
        'short_description',
        'full_description',
        'duration',
        'activity_type',
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
        'is_wheelchair_accessible',
        'is_stroller_friendly',
        'rules',
        'requirements',
        'disclaimers',

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

    public function activity_category()
    {
        return $this->belongsTo(TourCategory::class, 'category_id');
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function activityImage() {
        return $this->hasMany(ActivityImage::class, 'activity_id', 'id');
    }

    public function activityDate() {
        return $this->hasMany(ActivityDate::class, 'activity_id', 'id')->where('is_deleted',0);
    }

    public function activityExpectation() {
        return $this->hasMany(ActivityExpectation::class, 'activity_id', 'id');
    }

    public function activityExclusion() {
        return $this->hasMany(ActivityExclusion::class, 'activity_id', 'id');
    }

    public function activityPolicy() {
        return $this->hasMany(ActivityPolicy::class, 'activity_id', 'id');
    }

    public function activityInclusion() {
        return $this->hasMany(ActivityInclusion::class, 'activity_id', 'id');
    }

    public function activityReviews() {
        return $this->hasMany(ActivityReview::class, 'activity_id', 'id');
    }
}
