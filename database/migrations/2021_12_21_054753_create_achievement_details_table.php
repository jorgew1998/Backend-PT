<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creación de tabla detalle de logro con sus respectivos atributos
        Schema::create('achievement_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('achievement_id')
                ->references('id')
                ->on('achievements')
                ->onDelete('restrict');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
            $table->foreignId('theme_id')
                ->references('id')
                ->on('themes')
                ->onDelete('restrict');
            $table->foreignId('content_id')
                ->references('id')
                ->on('contents')
                ->onDelete('restrict');
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
        Schema::dropIfExists('achievement_details');
    }
}
