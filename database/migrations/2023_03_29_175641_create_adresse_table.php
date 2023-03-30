<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdresseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresse', function (Blueprint $table) {
            $table->integer('id_adresse', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_client');
            $table->string('nom_contact')->nullable();
            $table->string('adresse1', 128);
            $table->string('adresse2', 128)->nullable();
            $table->string('adresse3', 128)->nullable();
            $table->string('code_postal', 10);
            $table->string('ville');
            $table->string('pays');
            $table->string('tel1', 32);
            $table->string('tel2', 32);
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
        Schema::dropIfExists('adresse');
    }
}
