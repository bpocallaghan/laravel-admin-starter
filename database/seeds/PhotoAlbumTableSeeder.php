<?php

use Illuminate\Database\Seeder;
use App\Models\PhotoAlbum;

class PhotoAlbumTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker)
    {
        PhotoAlbum::truncate();

        for ($i = 0; $i < 6; $i++) {
            $item = PhotoAlbum::create([
                'name' => $faker->sentence(2)
            ]);

            for ($a = 0; $a < $faker->numberBetween(4, 8); $a++) {
                $r = random_int(1, 2);
                $item->photos()->create([
                    'name'     => $faker->sentence(2),
                    'filename' => "gallery-{$r}.png",
                ]);
            }
        }
    }
}