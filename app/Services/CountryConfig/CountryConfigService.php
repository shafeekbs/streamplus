<?php

namespace App\Services\CountryConfig;

use App\Services\CountryConfig\CountryConfigInterface;
use Exception;

/**
 * Class CountryConfigService
 *
 * This service provides configuration details (address fields and corresponding rules) specific to a given country.
 * It retrieves country-specific settings based on the provided country code.
 * If no configuration is found for the given country, a default configuration is returned.
 *
 * If need to change the logic of getting this configuration, create another class iplemtns the interface and update service provider
 * @package App\Services
 */
class CountryConfigService implements CountryConfigInterface {

    /**
     *
     * Retrieves the config fro a specific country
     *
     * @param array $country
     *   The country details, including the 'code' key. This implementation only needs country code as the config files are just named after the contry code.
     *   Array includes id,code and name, in ase in future needs id to fetch the details from other sources.
     * @return array
     *  Array including address fields and validation rules
     *
     * @throws Exception
     *
     *
     */
    public function getConfig(array $country): array
    {

        if(empty($country['code'])) {

            throw new Exception("Country Code not found");
        }

        $country_code = strtolower($country['code']);

        $countryConfig = "countries.{$country_code}";

        return config($countryConfig,config('countries.default'));
    }
}

