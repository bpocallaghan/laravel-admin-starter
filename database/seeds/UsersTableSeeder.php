<?php

use App\User;
use Carbon\Carbon;
use Bpocallaghan\Titan\Models\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker = null)
    {
        User::truncate();
        \DB::delete('TRUNCATE role_user');

        //-------------------------------------------------
        // Default Admin
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Laravel',
            'lastname'     => 'Admin',
            'cellphone'    => '123456789',
            'email'        => 'admin@laravel.local',
            'gender'       => 'ninja',
            'password'     => bcrypt('admin'),
            'confirmed_at' => Carbon::now()
        ]);

        $this->addAllRolesToUser($user);
        $user->attachRole('developer');

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
        $roles = Role::whereBetween('id', [2, 6])
            ->pluck('keyword', 'id')
            ->values();

        $user->syncRoles($roles);
    }
}
