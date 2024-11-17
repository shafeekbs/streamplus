<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [

        'name',
        'code',
        'currency'
    ];

    /**
     * @return HasMany
     *
     * A country can hold multiple adddresses
     */
    function address(): HasMany {

        return $this->hasMany(Address::class);
    }
}
