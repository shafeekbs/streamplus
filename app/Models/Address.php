<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'member_id',
        'address_line_1',
        'address_line_2',
        'city',
        'postal_code',
        'state',
        'country_id'
    ];

    /**
     * @return BelongsTo
     *
     * An address is associated with a member
     */
    function member(): BelongsTo {

        return $this->belongsTo(Member::class);

    }

    /**
     * @return BelongsTo
     *
     * An address is associated with a country
     */
    function country(): BelongsTo{

        return $this->belongsTo(Country::class);
    }
}
