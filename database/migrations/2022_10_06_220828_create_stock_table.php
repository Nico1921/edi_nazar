<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->integer('id_stock', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_client');
            $table->integer('id_produit')->index('stock_produit_id_produit_fk');
            $table->date('date_arrivage');
            $table->integer('quantite');
            $table->decimal('prix_achat_m2_ht', 10);
            $table->decimal('prix_achat_ht', 10);
            $table->string('container', 32)->nullable();
            $table->string('position')->nullable();
            $table->boolean('reception')->default(false)->index('reception_index');
            $table->boolean('interne')->default(false);
            $table->integer('id_achat')->index('id_achat_index');
            $table->string('gencode', 13);
            $table->integer('quantite_scan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
    }
}
