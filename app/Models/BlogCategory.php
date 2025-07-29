<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
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

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
