<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_menu', function (Blueprint $table) {
            $table->id();

            // Mulai
            $table->integer('parent_menu')->default(0);
            $table->string('menu_name');
            $table->integer('menu_order')->default(0);
            $table->string('menu_icon')->default('feather icon-minus');
            $table->string('menu_link')->default('#');
            $table->enum('menu_child',[0,1])->default(0);

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
        Schema::dropIfExists('to_menu');
    }
}
