<?php

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker)
    {
        Article::truncate();
        ArticleCategory::truncate();

        for ($i = 0; $i < 5; $i++) {
            $category = ArticleCategory::create([
                'name' => $faker->sentence(2)
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $item = Article::create([
                'title'       => $faker->sentence(3),
                'content'     => "<p>{$faker->paragraph(3)}</p>",
                'active_from' => $faker->dateTimeBetween('-5 weeks', '-1 weeks')->format('Y-m-d'),
                //'active_to' => $faker->dateTimeBetween('+5 weeks')
                'category_id' => $faker->numberBetween(1, 5),
                'slug'        => 'asd'
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