<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'email',
        'phone',
        'subscription_type'
    ];

    public static $subscription_types = [
        'free' => 'free',
        'premium' => 'premium'
    ];

    /**
     * @return HasOne
     *
     * A member can have one address
     */
    function address(): HasOne {

        return $this->hasOne(Address::class);
    }

    /**
     * @return HasOne
     *
     * A member can have only one payment info. This is as per the current implementation,
     * and can be changed to hasMany, if business needs to hold multiple cards for a member
     */
    function paymentInfo(): HasOne{

        return $this->hasOne(PaymentInfo::class);
    }
}
