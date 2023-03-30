<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouleurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couleur', function (Blueprint $table) {
            $table->integer('id_couleur', true);
            $table->dateTime('date_ajout')->nullable();
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_user_maj')->nullable();
            $table->string('nom_couleur', 128)->nullable();
            $table->string('url_couleur', 128)->nullable();
            $table->smallInteger('statut')->nullable();
            $table->integer('sort_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couleur');
    }
}
