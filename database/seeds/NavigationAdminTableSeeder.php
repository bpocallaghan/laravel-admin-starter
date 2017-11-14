<?php

use App\Models\NavigationAdmin;
use Illuminate\Database\Seeder;

class NavigationAdminTableSeeder extends Seeder
{
    public function run()
    {
        NavigationAdmin::truncate();
        DB::delete('TRUNCATE navigation_admin_role');

        $csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'navigation_admin.csv';
        $items = csv_to_array($csvPath);

        foreach ($items as $key => $item) {
            $row = NavigationAdmin::create([
                'id'                  => $item['id'],
                'title'               => $item['title'],
                'description'         => $item['description'],
                'slug'                => $item['slug'],
                'url'                 => $item['url'],
                'icon'                => $item['icon'],
                'help_index_title'    => $item['help_index_title'],
                'help_index_content'  => $item['help_index_content'],
                'help_create_title'   => $item['help_create_title'],
                'help_create_content' => $item['help_create_content'],
                'help_edit_title'     => $item['help_edit_title'],
                'help_edit_content'   => $item['help_edit_content'],
                'list_order'          => $item['list_order'],
                'is_hidden'           => $item['is_hidden'],
                'parent_id'           => $item['parent_id'],
                'url_parent_id'       => $item['url_parent_id'],
                'created_by'          => 1,
                'updated_by'          => 1,
            ]);

            $roles = explode(',', $item['roles']);
            $row->roles()->attach($roles);
        }
    }
}