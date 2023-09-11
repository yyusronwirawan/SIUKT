<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_user', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('nik', 30)->nullable();
            $table->text('password')->nullable();
            $table->enum('status', ['Bagian Keuangan']);
            $table->text('foto_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('user');
    }
}
