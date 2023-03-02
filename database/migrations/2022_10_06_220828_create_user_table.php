<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id_user', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->string('code_user', 3);
            $table->string('lastname', 32);
            $table->string('firstname', 32);
            $table->string('email', 128);
            $table->string('tel', 10);
            $table->string('login', 32);
            $table->string('mdp', 32);
            $table->string('password', 128);
            $table->boolean('statut')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
