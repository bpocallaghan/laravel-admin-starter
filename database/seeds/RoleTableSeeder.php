<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        Role::truncate();

        // basic website only role
        Role::create([
            'icon'    => 'user',
            'title'   => 'Website',
            'slug'    => '/',
            'keyword' => 'website',
        ]);

        // basic admin role
        Role::create([
            'icon'    => 'user-secret',
            'title'   => 'Basic Admin',
            'slug'    => '/admin',
            'keyword' => 'admin',
        ]);

        // admin and analytics
        Role::create([
            'icon'    => 'user-circle',
            'title'   => 'Analytics',
            'slug'    => '/admin',
            'keyword' => 'analytics',
        ]);

        Role::create([
            'icon'    => 'user-secret',
            'title'   => 'Admin',
            'slug'    => '/admin',
            'keyword' => 'admin_super',
        ]);

        Role::create([
            'icon'    => 'universal-access',
            'title'   => 'Developer',
            'slug'    => '/admin',
            'keyword' => 'developer',
        ]);
    }
}