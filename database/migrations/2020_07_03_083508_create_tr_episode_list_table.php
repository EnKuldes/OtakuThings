<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrEpisodeListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_episode_list', function (Blueprint $table) {
            $table->id();

            // Mulai
            $table->integer('jenis_survey');
            $table->integer('num');
            $table->string('nama_episode', 255);
            $table->string('deskripsi_episode', 255);

            $table->enum('is_enabled',[0,1])->default(1);
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
        Schema::dropIfExists('tr_episode_list');
    }
}
