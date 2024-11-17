<?php

namespace App\Services\CountryConfig;

/**
 * Interface CountryConfigInterface
 *
 * Defines the contract for fetching country-specific configurations.
 *
 * @package App\Services\CountryConfig
 */
interface CountryConfigInterface{

    /**
     * @param array $country
     *
     * $country = array('country_code' => 'US', 'country_id' => 1)
     *
     * @return array
     */
    public function getConfig(array $country): array;

}
