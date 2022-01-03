<?php

namespace Database\Seeders;

use App\Models\ContentDetail;
use Illuminate\Database\Seeder;

class ContentsDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla
        ContentDetail::truncate();
    }
}
