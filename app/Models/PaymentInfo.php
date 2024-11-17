<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentInfo extends Model
{
    protected $fillable = [

        'member_id',
        'card_number',
        'expiry',
        'cvv'
    ];

    /**
     * @return HasOne
     *
     * A payment info can be associated with only one member
     */
    function member(): HasOne{

        return $this->hasOne(Member::class);
    }
}
