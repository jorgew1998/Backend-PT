<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        Content::truncate();

        //Llamada a la herramienta faker
        $faker = \Faker\Factory::create();

        // Obtenemos todos los temas de la base de datos
        $themes = Theme::all();

        //Creación de un contenido para cada tema
        foreach ($themes as $theme) {
            Content::create([
                'description' => $faker->sentence,
                'question' => $faker->sentence,
                'answer_1' => $faker->sentence,
                'answer_2' => $faker->sentence,
                'answer_3' => $faker->sentence,
                'answer_4' => $faker->sentence,
                'feedback' => $faker->sentence,
                'theme_id' => $theme->id,
            ]);
        }
    }
}
