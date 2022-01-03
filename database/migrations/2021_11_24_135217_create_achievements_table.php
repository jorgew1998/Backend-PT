<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creación de tabla logros con sus respectivos atributos

        Schema::create('achievements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('item_1');
            $table->string('item_2');
            $table->string('item_3');
            $table->string('item_4');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements');
    }
}
