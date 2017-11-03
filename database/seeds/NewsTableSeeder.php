<?php

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker)
    {
        News::truncate();
        NewsCategory::truncate();

        for ($i = 0; $i < 5; $i++) {
            $category = NewsCategory::create([
                'name' => $faker->sentence(2)
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            $item = News::create([
                'slug'        => '',
                'title'       => $faker->sentence(3),
                'content'     => "<p>{$faker->paragraph(3)}</p>",
                'active_from' => $faker->dateTimeBetween('-5 weeks', '-1 weeks')->format('Y-m-d'),
                //'active_to' => $faker->dateTimeBetween('+5 weeks')
                'category_id' => $faker->numberBetween(1, 5),
            ]);

            for ($a = 0; $a < $faker->numberBetween(2, 4); $a++) {
                $r = random_int(1, 2);
                $item->photos()->create([
                    'name'     => $faker->sentence(2),
                    'filename' => "news-{$r}.jpg",
                ]);
            }
        }
    }
}