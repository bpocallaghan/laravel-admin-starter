<?php

use Illuminate\Database\Seeder;
use Bpocallaghan\Testimonials\Models\Testimonial;

class TestimonialTableSeeder extends Seeder
{
    public function run(\Faker\Generator $faker)
    {
        Testimonial::truncate();

        for ($i = 0; $i < 5; $i++) {
            $item = Testimonial::create([
                'customer'    => $faker->name(),
                'link'        => $faker->url,
                'description' => "<p>" . $faker->paragraph(3) . "</p>",
            ]);
        }
    }
}