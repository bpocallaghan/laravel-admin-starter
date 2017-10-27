<?php



use Illuminate\Database\Seeder;
use Bpocallaghan\Changelogs\Models\Changelog;

class ChangelogTableSeeder extends Seeder
{
    /**
     * @param \Faker\Generator $faker
     */
    public function run(\Faker\Generator $faker)
    {
        Changelog::truncate();

        for ($i = 0; $i < $faker->numberBetween(3, 6); $i++) {

            Changelog::create([
                'version' => "0.0.{$i}",
                'date_at' => $faker->dateTimeBetween('-5 weeks'),
                'content' => '<p>' . $faker->paragraph(3) . '</p>',
            ]);
        }
    }
}