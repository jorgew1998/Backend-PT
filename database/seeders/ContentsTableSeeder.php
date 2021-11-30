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

        $faker = \Faker\Factory::create();

        //// Obtenemos todos los themas de la base de datps
        $themes = Theme::all();

        //Obtenemos la lista de usuarios
       // $users = User::all();
        //foreach ($users as $user) {
            // iniciamos sesión con cada uno
          //  JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
        //}


        //Crear un contenido para cada tema
        foreach ($themes as $theme) {
            Content::create([
                'description' => $faker->paragraph,
                'question' => $faker->sentence,
                'answer' => $faker->sentence,
                'theme_id' => $theme->id,
            ]);
        }
    }
}
