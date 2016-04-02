<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = User::find(1);

        if (!$user) {
            User::create([
                'firstname'     => 'Laravel',
                'lastname'      => 'Administrator',
                'cellphone'     => '123456789',
                'email'         => 'admin@laravel-starter.com',
                'gender'        => 'male',
                'password'      => bcrypt('admin'),
                'registered_at' => Carbon\Carbon::now(),
                'activated_at'  => Carbon\Carbon::now()
            ]);
        }
    }
}
