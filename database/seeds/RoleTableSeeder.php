<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        Role::truncate();

        Role::create([
            'icon'    => 'user',
            'title'   => 'Basic',
            'slug'    => '/',
            'keyword' => 'basic',
            'level'   => '1',
        ]);

        Role::create([
            'icon'    => 'user-secret',
            'title'   => 'Admin',
            'slug'    => 'admin',
            'keyword' => 'admin',
            'level'   => '10',
        ]);

        Role::create([
            'icon'    => 'universal-access',
            'title'   => 'Developer',
            'slug'    => 'admin',
            'keyword' => 'developer',
            'level'   => '20',
        ]);
    }
}