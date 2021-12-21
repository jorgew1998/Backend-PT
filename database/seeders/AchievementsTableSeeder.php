<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        //Obtenemos la lista de usuarios
        //$users = User::all();
       // foreach ($users as $user) {
            // iniciamos sesión con cada uno
           // JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            //Datos ficticios
            $num_achievements = 6;
            for ($j = 0; $j < $num_achievements; $j++) {
                Achievement::create([
                    'title' => $faker->sentence,
                    'description' => $faker->sentence,
                ]);
            }
        }

    //}
}
