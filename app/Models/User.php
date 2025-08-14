<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'phone',
        'paypal_email',
        'is_show_email_phone',
        'about_yourself',
        'avatar',
        'home_airport',
        'address',
        'city',
        'state',
        'zip_code',
        'country_id',
        'created_at',
        'updated_at',
        'is_deleted',
        'date_deleted',
        'deletedby_id',
        'email_otp',
        'email_otp_expires_at',
        'email_verified_at',
        'alternative_phone',
        'gender',
        'stripe_customer_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_deleted',
        'date_deleted',
        'deletedby_id',
        'email_otp',
        'email_otp_expires_at',
    ];
    protected $guard_name = 'api';
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
