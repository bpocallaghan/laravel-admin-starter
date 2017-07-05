<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(NavigationAdminTableSeeder::class);
        $this->call(NavigationWebsiteTableSeeder::class);

        $this->call(SubscriptionPlanFeaturesSeeder::class);
        $this->call(SubscriptionPlanTableSeeder::class);
    }
}
