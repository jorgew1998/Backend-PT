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

        $faker = \Faker\Factory::create();

        //Obtenemos la lista de usuarios
        $users = User::all();
        foreach ($users as $user) {
            // iniciamos sesión con cada uno
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            $num_themes = 6;
            for ($i = 0; $i <$num_themes; $i++) {
                Theme::create([
                    'title' => $faker->sentence,
                    'difficulty' => $faker->word,
                    'advance' => $faker->word,
                ]);
            }
        }

        // Crear temas ficticios en la tabla

    }
}
