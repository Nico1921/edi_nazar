<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientEdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_edi', function (Blueprint $table) {
            $table->integer('id_client_edi', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj');
            $table->string('nom', 128);
            $table->string('prenom', 128);
            $table->string('email', 128);
            $table->string('tel', 10);
            $table->date('date_commande');
            $table->string('ref_externe', 250)->nullable();
            $table->string('nom_adresse', 128);
            $table->string('adresse1', 50);
            $table->string('adresse2', 50)->nullable();
            $table->string('adresse3', 50)->nullable();
            $table->string('pays', 128);
            $table->string('code_postal', 5);
            $table->string('ville', 128);
            $table->string('nom_adresse_facturation', 128);
            $table->string('adresse1_facturation', 50);
            $table->string('adresse2_facturation', 50)->nullable();
            $table->string('adresse3_facturation', 50)->nullable();
            $table->string('pays_facturation', 128);
            $table->string('code_postal_facturation', 5);
            $table->string('ville_facturation', 128);
            $table->string('num_commande', 128);
            $table->integer('quantiter');
            $table->decimal('poids', 10);
            $table->decimal('total_ht', 10);
            $table->decimal('total_taxe', 10);
            $table->decimal('total_ttc', 10);
            $table->decimal('total_m2', 10);
            $table->integer('id_panier_edi')->index('fk_id_panier_edi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_edi');
    }
}
