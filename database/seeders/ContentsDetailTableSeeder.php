<?php

namespace Database\Seeders;

use App\Models\ContentDetail;
use Illuminate\Database\Seeder;

class ContentsDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContentDetail::truncate();

        $faker = \Faker\Factory::create();

        $content_details = 3;

        for ($i = 0; $i <$content_details; $i++) {
            ContentDetail::create([
                'content_id' => $faker->numberBetween(1,6),
                'user_id' => $faker->numberBetween(1,11),
                'theme_id' => $faker->numberBetween(1,6),
                'date' => $faker->date,
            ]);
        }
    }
}
