<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_stock', function (Blueprint $table) {
            $table->integer('id_commande_stock', true);
            $table->integer('id_commande')->index('id_commande');
            $table->integer('id_commande_list')->index('id_commande_list');
            $table->integer('id_produit')->index('id_produit');
            $table->integer('id_stock');
            $table->integer('quantite');
            $table->boolean('etape')->default(true);
            $table->integer('id_preparation');
            $table->integer('id_livraison');
            $table->integer('id_facture')->nullable();
            $table->integer('id_commande_mkp')->nullable();
            $table->integer('id_commande_mkp_list')->nullable();
            $table->date('date_expedition')->nullable();
            $table->string('tracking', 128);
            $table->integer('qte_preparee')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_stock');
    }
}
