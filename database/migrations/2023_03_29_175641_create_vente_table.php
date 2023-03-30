<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vente', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('date_ajout')->nullable();
            $table->dateTime('date_maj')->nullable();
            $table->integer('produit_id')->index('idx_produit_id');
            $table->integer('produit_ref_id')->nullable()->index('idx_produit_ref_id');
            $table->string('societe', 32)->nullable();
            $table->integer('qte')->default(0);
            $table->boolean('maj')->default(false);
            $table->string('ean', 13)->nullable();
            $table->string('sku', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vente');
    }
}
