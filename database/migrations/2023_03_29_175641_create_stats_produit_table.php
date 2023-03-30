<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_produit', function (Blueprint $table) {
            $table->integer('id_stats_produit', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_produit')->index('id_produit');
            $table->integer('qte_achetee')->default(0);
            $table->integer('qte_commande')->default(0);
            $table->integer('qte_arrivage')->default(0);
            $table->integer('stock_restant')->default(0)->index('stock_restant_index');
            $table->integer('stock_option')->default(0);
            $table->integer('stock_bloque')->default(0);
            $table->integer('qte_destocke')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_produit');
    }
}
