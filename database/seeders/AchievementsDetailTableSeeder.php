<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\AchievementDetail;
use Illuminate\Database\Seeder;

class AchievementsDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        AchievementDetail::truncate();
    }
}
