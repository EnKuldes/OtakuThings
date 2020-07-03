<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Informasi Akun
            $table->string('name');
            $table->string('email')->unique();
            $table->string('perner')->unique();
            $table->string('posisi')->nullable();
            $table->integer('user_level')->default(0);
            $table->string('user_image')->default('avatar-s-1.png');
            // Informasi Akun
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(bcrypt('npc@nps2020'));
            $table->enum('is_enabled',[0,1])->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
