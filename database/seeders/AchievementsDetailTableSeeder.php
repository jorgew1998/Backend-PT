<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\AchievementDetail;
use Illuminate\Database\Seeder;

class AchievementsDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AchievementDetail::truncate();

        $faker = \Faker\Factory::create();

        $achievememt_details = 3;

        for ($i = 0; $i <$achievememt_details; $i++) {
            AchievementDetail::create([
                'achievement_id' => $faker->numberBetween(1,6),
                'user_id' => $faker->numberBetween(1,11),
                'theme_id' => $faker->numberBetween(1,6),
                'content_id' => $faker->numberBetween(1,6),
            ]);
        }

    }
}
