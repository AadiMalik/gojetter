<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_date',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'zipcode',
        'address',
        'quantity',
        'sub_total',
        'tax_percent',
        'tax_amount',
        'discount',
        'total',
        'payment_method',
        'card_id',
        'currency_id',
        'coupon_id',
        'status',
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

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class)->where('is_deleted', 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->where('is_deleted', 0);
    }

    public function card()
    {
        return $this->belongsTo(CustomerCard::class, 'card_id')->where('is_deleted', 0);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id')->where('is_deleted', 0);
    }
}
