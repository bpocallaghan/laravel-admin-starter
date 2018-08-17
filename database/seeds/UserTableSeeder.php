<?php

use App\Models\User;
use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker)
    {
        User::truncate();
        //DB::delete('TRUNCATE role_user'); //Unnecessary in Laravel 5.6

        //-------------------------------------------------
        // Ben-Piet
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Ben-Piet',
            'lastname'     => 'O\'Callaghan',
            'cellphone'    => '123456789',
            'email'        => 'bpocallaghan@gmail.com',
            'gender'       => 'ninja',
            'password'     => bcrypt('password'),
            'confirmed_at' => Carbon::now()
        ]);

        $this->addAllRolesToUser($user);

        //-------------------------------------------------
        // GitHub
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Github',
            'lastname'     => 'Administrator',
            'cellphone'    => '123456789',
            'email'        => 'github@bpocallaghan.co.za',
            'gender'       => 'male',
            'password'     => bcrypt('github'),
            'confirmed_at' => Carbon::now()
        ]);

        $this->addAllRolesToUser($user);

        //-------------------------------------------------
        // Default Admin
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Admin',
            'lastname'     => 'Laravel Starter',
            'cellphone'    => '123456789',
            'email'        => 'admin@laravel-admin.dev',
            'gender'       => 'male',
            'password'     => bcrypt('admin'),
            'confirmed_at' => Carbon::now()
        ]);

        $this->addAllRolesToUser($user);

        // dummy users
        /*for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'firstname'    => $faker->firstName,
                'lastname'     => $faker->lastName,
                'cellphone'    => $faker->phoneNumber,
                'email'        => $faker->email,
                'gender'       => $faker->randomElement(['male', 'female']),
                'password'     => bcrypt('secret'),
                'confirmed_at' => Carbon::now()
            ]);

            $user->syncRoles([
                \App\Models\Role::$WEBSITE,
            ]);
        }*/
    }

    /**
     * Add all the roles to the user
     * @param $user
     */
    private function addAllRolesToUser($user)
    {
        // only 2 - to 5 are needed
        $roles = Role::whereBetween('id', [2, 5])
            ->pluck('keyword', 'id')
            ->values();

        $user->syncRoles($roles);
    }
}
