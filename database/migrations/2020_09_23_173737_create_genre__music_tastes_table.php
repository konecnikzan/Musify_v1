<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenreMusicTastesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre__music_tastes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('music_taste_id');
            $table->unsignedBigInteger('genre_id');

            $table->foreign('music_taste_id')->references('id')->on('music_tastes');
            $table->foreign('genre_id')->references('id')->on('genres');
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
        Schema::dropIfExists('genre__music_tastes');
    }
}
