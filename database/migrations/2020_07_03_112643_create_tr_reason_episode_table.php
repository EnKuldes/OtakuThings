<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrReasonEpisodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_reason_episode', function (Blueprint $table) {
            $table->id();

            // Mulai
            $table->integer('jenis_survey');
            $table->integer('num_episode');
            $table->integer('num');
            $table->integer('reason_category');
            $table->string('reason_desc', 255);
            $table->string('ket_episode', 255);

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
        Schema::dropIfExists('tr_reason_episode');
    }
}
