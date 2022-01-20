<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Cración de tabla contenidos con sus respectivos atributos

        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->text('question');
            $table->text('answer_1');
            $table->text('answer_2');
            $table->text('answer_3');
            $table->text('answer_4');
            $table->text('feedback');
            $table->string('image')->nullable();
            $table->foreignId('theme_id')
                ->references('id')
                ->on('themes')
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
        Schema::dropIfExists('contents');
    }
}
