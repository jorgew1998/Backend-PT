<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        Achievement::truncate();

        $faker = \Faker\Factory::create();

        //Crear contenidos ficitcios para la tabla
        for ($i = 0; $i < 6; $i++) {
            Achievement::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
