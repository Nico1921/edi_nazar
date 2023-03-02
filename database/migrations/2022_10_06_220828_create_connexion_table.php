<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnexionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connexion', function (Blueprint $table) {
            $table->integer('id_connexion', true);
            $table->integer('id_client');
            $table->string('login', 128);
            $table->string('mdp', 32);
            $table->string('password', 32);
            $table->boolean('statut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connexion');
    }
}
