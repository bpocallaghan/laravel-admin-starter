<?php

use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use App\Models\Suburb;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker)
    {
        City::truncate();
        Suburb::truncate();
        Country::truncate();
        Province::truncate();

        $csvPath = database_path() . '\seeds\csv\\' . 'countries.csv';
        $items = csv_to_array($csvPath);
        foreach ($items as $key => $item) {
            Country::create([
                'title'      => trim($item['title']),
                'zoom_level' => $item['zoom_level'],
                'latitude'   => $item['latitude'],
                'longitude'  => $item['longitude'],
            ]);
        }

        $csvPath = database_path() . '\seeds\csv\\' . 'provinces.csv';
        $items = csv_to_array($csvPath);
        foreach ($items as $key => $item) {
            Province::create([
                'title'      => trim($item['title']),
                'zoom_level' => $item['zoom_level'],
                'latitude'   => $item['latitude'],
                'longitude'  => $item['longitude'],
                'country_id' => $item['country_id'],
            ]);
        }

        $csvPath = database_path() . '\seeds\csv\\' . 'cities.csv';
        $items = csv_to_array($csvPath);
        foreach ($items as $key => $item) {
            City::create([
                'title'       => trim($item['title']),
                'zoom_level'  => $item['zoom_level'],
                'latitude'    => $item['latitude'],
                'longitude'   => $item['longitude'],
                'province_id' => $item['province_id'],
            ]);
        }

        $csvPath = database_path() . '\seeds\csv\\' . 'suburbs.csv';
        $items = csv_to_array($csvPath);
        foreach ($items as $key => $item) {
            Suburb::create([
                'title'      => trim($item['title']),
                'zoom_level' => $item['zoom_level'],
                'latitude'   => $item['latitude'],
                'longitude'  => $item['longitude'],
                'city_id'    => $item['city_id'],
            ]);
        }
    }
}