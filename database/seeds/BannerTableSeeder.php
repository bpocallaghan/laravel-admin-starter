<?php

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerTableSeeder extends Seeder
{
    public function run()
    {
        Banner::truncate();
        $csvPath = database_path() . '/seeds/csv/' . 'banners.csv';
        $items = csv_to_array($csvPath);

        foreach ($items as $key => $item) {
            Banner::create([
                'id'          => $item['id'],
                'name'        => $item['name'],
                'summary'     => $item['summary'],
                'action_name' => $item['action_name'],
                'action_url'  => $item['action_url'],
                'image'       => $item['image'],
                'active_from' => \Carbon\Carbon::now(),
                'is_website'  => $item['is_website'],
                'hide_name'   => $item['hide_name'],
            ]);
        }
    }
}