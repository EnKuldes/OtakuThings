<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmDataEnterpiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_data_enterpise', function (Blueprint $table) {
            $table->id();

            $table->string('npsid')->unique();
            $table->string('seg')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('bp')->nullable();
            $table->string('pic')->nullable();
            $table->string('episode')->nullable();
            $table->string('treg')->nullable();
            $table->string('witel')->nullable();
            $table->string('produk')->nullable();
            $table->string('bp_name')->nullable();
            $table->json('kolom_lainnya')->nullable();
            $table->string('agent')->default('-');

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
        Schema::dropIfExists('tm_data_enterpise');
    }
}
