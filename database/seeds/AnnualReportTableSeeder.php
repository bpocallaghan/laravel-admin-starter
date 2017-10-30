<?php

use Illuminate\Database\Seeder;
use Bpocallaghan\Corporate\Models\AnnualReport;

class AnnualReportTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker)
    {
        AnnualReport::truncate();

        for ($i = 0; $i < 5; $i++) {
            $item = AnnualReport::create([
                'name'        => $faker->sentence(2),
                'content'     => $faker->paragraph(4),
                'active_from' => $faker->dateTimeBetween('-5 weeks', '-1 weeks')->format('Y-m-d'),
            ]);

            if ($faker->numberBetween(1, 2) == 1) {
                $item->update([
                    'active_to' => $faker->dateTimeBetween('+5 weeks', '+15 weeks')->format('Y-m-d')
                ]);
            }

            $item->documents()->create([
                'name'     => $faker->sentence(2),
                'filename' => 'example.pdf',
            ]);
        }
    }
}