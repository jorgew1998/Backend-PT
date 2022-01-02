<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        //Llamada a la herramienta faker
        $faker = \Faker\Factory::create();


        //Creación de temas ficticios
        $num_themes = 6;
        for ($i = 0; $i <$num_themes; $i++) {
            Theme::create([
                'title' => $faker->sentence,
                'description' => $faker->sentence(),
                'difficulty' => $faker->word,
                'advance' => $faker->word,
            ]);
        }
    }
}
