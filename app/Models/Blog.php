<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'video_url',
        'blog_category_id',
        'author',
        
        'is_active',
        'is_deleted',
        'createdby_id',
        'updatedby_id',
        'deletedby_id',
        'date_deleted',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'createdby_id',
        'updatedby_id',
        'deletedby_id',
        'is_deleted',
        'date_deleted'
    ];
    protected $appends = ['image_url'];
    
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/app/public/' .  $this->image);
        }

        return null;
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
