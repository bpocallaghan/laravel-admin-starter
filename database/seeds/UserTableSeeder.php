<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        //-------------------------------------------------
        // Ben-Piet
        //-------------------------------------------------
        $user = User::create([
            'firstname'      => 'Ben-Piet',
            'lastname'       => 'O\'Callaghan',
            'cellphone'      => '123456789',
            'email'          => 'bpocallaghan@gmail.com',
            'gender'         => 'male',
            'password'       => bcrypt('admin'),
            'security_level' => 10,
            'confirmed_at'   => Carbon::now()
        ]);

        $user->syncRoles([
            \App\Models\Role::$ADMIN,
            \App\Models\Role::$DEVELOPER,
        ]);

        //-------------------------------------------------
        // GitHub
        //-------------------------------------------------
        $user = User::create([
            'firstname'      => 'Github',
            'lastname'       => 'Administrator',
            'cellphone'      => '123456789',
            'email'          => 'github@bpocallaghan.co.za',
            'gender'         => 'male',
            'password'       => bcrypt('github'),
            'security_level' => 10,
            'confirmed_at'   => Carbon::now()
        ]);

        $user->syncRoles([
            \App\Models\Role::$ADMIN,
            \App\Models\Role::$DEVELOPER,
        ]);
    }
}