<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanierEdiListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panier_edi_list', function (Blueprint $table) {
            $table->integer('id_panier_edi_list', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj');
            $table->integer('id_produit')->index('fk_produit');
            $table->decimal('prix_ht_unitaire', 10);
            $table->decimal('prix_taxe_unitaire', 10);
            $table->decimal('prix_ttc_unitaire', 10);
            $table->integer('quantiter');
            $table->decimal('prix_ht_total', 10);
            $table->decimal('prix_taxe_total', 10);
            $table->decimal('prix_ttc_total', 10);
            $table->integer('id_client_edi')->index('fk_client_edi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panier_edi_list');
    }
}
