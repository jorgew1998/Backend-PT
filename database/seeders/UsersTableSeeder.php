<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        User::truncate();

        //Llamada a la herramienta faker
        $faker = \Faker\Factory::create();

        // Creación de 2 administardores
        $password = Hash::make('123123');

        User::create([
            'name' => 'Administrador1',
            'email' => 'admin1@gmail.com',
            'password' => $password,
            'experience' => null,
            'progress' => null,
            'rank' => null,
            'level' => null,
            'role' => 'ROLE_SUPERADMIN'
        ]);
        User::create([
            'name' => 'Administrador2',
            'email' => 'admin2@gmail.com',
            'password' => $password,
            'experience' => null,
            'progress' => null,
            'rank' => null,
            'level' => null,
            'role' => 'ROLE_SUPERADMIN'
        ]);

        // Generar usuarios ficticios
       // for ($i = 0; $i < 10; $i++) {
         //   User::create([
           //     'name' => $faker->name,
           //     'email' => $faker->email,
           //     'password' => $password,
           //     'experience' => $faker->numerify('####'),
           //     'progress'=> $faker->numerify('###'),
           //     'rank' => $faker->word,
           //     'level' => $faker->numerify('##')
           // ]);
        //}

    }
}
