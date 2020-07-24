<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmDataConsumerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_data_consumer', function (Blueprint $table) {
            $table->id();

            $table->string('npsid')->unique();
            $table->string('nama_pelanggan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('nd')->nullable();
            $table->string('nd_reference')->nullable();
            $table->string('episode')->nullable();
            $table->string('treg')->nullable();
            $table->string('witel')->nullable();
            $table->string('produk')->nullable();
            $table->string('ncli')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('tm_data_consumer');
    }
}
