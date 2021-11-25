<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

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

        //Crear contenidos ficitcios para la tabla
        for ($i = 0; $i < 6; $i++) {
        Content::create([
            'description' => $faker->paragraph,
            'question' => $faker->sentence,
            'answer' => $faker->sentence,
        ]);
    }
    }
}
