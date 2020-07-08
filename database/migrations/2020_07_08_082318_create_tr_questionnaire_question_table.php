<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrQuestionnaireQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_questionnaire_question', function (Blueprint $table) {
            $table->id();

            // Mulai
            $table->integer('jenis_survey');
            $table->integer('num_episode');
            $table->integer('num_kuis');
            $table->longText('kuis');
            $table->string('jenis_input');
            $table->longText('range')->nullable();
            $table->integer('jenis_kuisioner')->default(1); // 1 untuk jenis kuisioner Utama, 2 untuk additional kuisioner

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
        Schema::dropIfExists('tr_questionnaire_question');
    }
}
