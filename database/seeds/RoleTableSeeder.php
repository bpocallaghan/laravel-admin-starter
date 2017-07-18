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
            'name'    => 'Website',
            'slug'    => '/',
            'keyword' => 'website',
        ]);

        // basic admin role
        Role::create([
            'icon'    => 'user-secret',
            'name'    => 'Basic Admin',
            'slug'    => '/admin',
            'keyword' => 'admin',
        ]);

        // admin and analytics
        Role::create([
            'icon'    => 'user-circle',
            'name'    => 'Analytics',
            'slug'    => '/admin',
            'keyword' => 'analytics',
        ]);

        Role::create([
            'icon'    => 'user-secret',
            'name'    => 'Admin',
            'slug'    => '/admin',
            'keyword' => 'admin_super',
        ]);

        Role::create([
            'icon'    => 'universal-access',
            'name'    => 'Developer',
            'slug'    => '/admin',
            'keyword' => 'developer',
        ]);
    }
}