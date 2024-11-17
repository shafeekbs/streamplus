<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Insert countries data
        $countries = [
            ['name' => 'United Arab Emirates', 'code' => 'UAE', 'currency' => 'AED'],
            ['name' => 'United States', 'code' => 'US', 'currency' => 'USD'],
            ['name' => 'Canada', 'code' => 'CA', 'currency' => 'CAD'],
            ['name' => 'United Kingdom', 'code' => 'GB', 'currency' => 'GBP'],
            ['name' => 'Australia', 'code' => 'AU', 'currency' => 'AUD'],
            ['name' => 'Germany', 'code' => 'DE', 'currency' => 'EUR'],
            ['name' => 'France', 'code' => 'FR', 'currency' => 'EUR'],
            ['name' => 'India', 'code' => 'IN', 'currency' => 'INR'],
            ['name' => 'China', 'code' => 'CN', 'currency' => 'CNY'],
            ['name' => 'Japan', 'code' => 'JP', 'currency' => 'JPY'],
            ['name' => 'Brazil', 'code' => 'BR', 'currency' => 'BRL'],
        ];

      //  DB::table('countries')->truncate();
        DB::table('countries')->insert($countries);

    }
}
