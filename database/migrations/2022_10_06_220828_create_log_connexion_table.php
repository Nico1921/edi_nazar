<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogConnexionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_connexion', function (Blueprint $table) {
            $table->integer('id_log_connexion', true);
            $table->integer('id_user');
            $table->string('adresse_IP');
            $table->dateTime('date_connexion');
            $table->string('statut_connexion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_connexion');
    }
}
