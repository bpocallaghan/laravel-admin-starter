<?php

use App\Models\NavigationWebsite;
use Illuminate\Database\Seeder;

class NavigationWebsiteTableSeeder extends Seeder
{
    public function run()
    {
        NavigationWebsite::truncate();

        $csvPath = database_path() . '/seeds/csv/' . 'navigation_website.csv';
        $items = csv_to_array($csvPath);

        foreach ($items as $key => $item) {
            NavigationWebsite::create([
                'id'                 => $item['id'],
                'title'              => $item['title'],
                'description'        => $item['description'],
                'html_title'         => $item['html_title'],
                'html_description'   => $item['html_description'],
                'slug'               => $item['slug'],
                'url'                => $item['url'],
                'icon'               => $item['icon'],
                'is_main'            => $item['is_main'],
                'list_main_order'    => $item['list_main_order'],
                'is_footer'          => $item['is_footer'],
                'is_hidden'          => $item['is_hidden'],
                'parent_id'          => $item['parent_id'],
                'url_parent_id'      => $item['url_parent_id'],
                'created_by'         => 1,
                'updated_by'         => 1,
            ]);
        }
    }
}