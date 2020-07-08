<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrQuestionnaireGreetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_questionnaire_greeting', function (Blueprint $table) {
            $table->id();

            // Mulai
            $table->integer('jenis_survey');
            $table->integer('jenis_salam');
            $table->text('ucapan_salam');

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
        Schema::dropIfExists('tr_questionnaire_greeting');
    }
}
