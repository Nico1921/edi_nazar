<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtatCommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etat_commande', function (Blueprint $table) {
            $table->integer('id_etat_commande', true);
            $table->string('libelle_etat', 128);
            $table->string('color_etat', 7)->default('#000000');
            $table->tinyInteger('statut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etat_commande');
    }
}
