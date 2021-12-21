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
        Schema::disableForeignKeyConstraints();
        $this->call(UsersTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(ContentsTableSeeder::class);
        $this->call(AchievementsTableSeeder::class);
        //$this->call(AchievementDetail::class);
        //$this->call(ContentDetail::class);
        Schema::enableForeignKeyConstraints();

    }
}
