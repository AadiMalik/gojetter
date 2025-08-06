<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDownload extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'file_type',
        'file_path'
    ];
    protected $appends = ['file_path_url'];
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
    public function getFilePathUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/app/public/' .  $this->file_path);
        }

        return null;
    }
}
