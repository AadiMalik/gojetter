<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'user_id',
        'is_default',
        'stripe_payment_method_id',
        'card_brand',
        'card_last_four',
        'exp_month',
        'exp_year',
        'cvc',
        'card_holder_name',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
