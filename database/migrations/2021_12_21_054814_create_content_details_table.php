<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('content_id')
                ->references('id')
                ->on('contents')
                ->onDelete('restrict');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
            $table->foreignId('theme_id')
                ->references('id')
                ->on('themes')
                ->onDelete('restrict');
            $table->date('date');
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
        Schema::dropIfExists('content_details');
    }
}
