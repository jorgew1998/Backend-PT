<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar tabla
        Theme::Truncate();

        $faker = \Faker\Factory::create();

        // Crear temas ficticios en la tabla
        for ($i = 0; $i < 6; $i++) {
            Theme::create([
                'title' => $faker->sentence,
                'difficulty' => $faker->word,
                'advance' => $faker->word,
            ]);
        }
    }
}
