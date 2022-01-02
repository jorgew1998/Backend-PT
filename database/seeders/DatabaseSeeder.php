<?php

namespace Database\Seeders;


use App\Models\AchievementDetail;
use App\Models\ContentDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Desactivar las restrcciones de claves foraneas momentaneamente
        Schema::disableForeignKeyConstraints();
        //Ejecutar los seeders
        $this->call(UsersTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(ContentsTableSeeder::class);
        $this->call(AchievementsTableSeeder::class);
        //Activar las restrcciones de claves foraneas nuevamente
        Schema::enableForeignKeyConstraints();

    }
}
