<?php



use Bpocallaghan\Locations\Models\City;
use Bpocallaghan\Locations\Models\Country;
use Bpocallaghan\Locations\Models\Province;
use Bpocallaghan\Locations\Models\Suburb;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    public function run(\Faker\Generator $faker)
    {
        City::truncate();
        Suburb::truncate();
        Country::truncate();
        Province::truncate();

        $csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'countries.csv';
        $items = csv_to_array($csvPath);
        foreach ($items as $key => $item) {
            Country::create([
                'title'      => trim($item['title']),
                'zoom_level' => $item['zoom_level'],
                'latitude'   => $item['latitude'],
                'longitude'  => $item['longitude'],
            ]);
        }

        $csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'provinces.csv';
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

        $csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'cities.csv';
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

        $csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'suburbs.csv';
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