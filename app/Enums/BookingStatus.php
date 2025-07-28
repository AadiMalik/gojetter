<?php

namespace App\Enums;

use Illuminate\Auth\Events\Logout;

class BookingStatus
{
    const PENDING    = 'pending';
    const CONFIRMED  = 'confirmed';
    const PAID       = 'paid';
    const REJECTED   = 'rejected';
    const COMPLETED  = 'completed';
    const REFUNDED   = 'refunded';
    const NO_SHOW    = 'no_show';
    const CANCELED   = 'canceled';
}
