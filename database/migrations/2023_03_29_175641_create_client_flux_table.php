<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientFluxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_flux', function (Blueprint $table) {
            $table->integer('id_client_flux', true);
            $table->integer('id_client')->unique('id_client');
            $table->boolean('gencode_sku')->default(true);
            $table->boolean('gamme')->default(true);
            $table->boolean('prix_achat_ht')->default(true);
            $table->boolean('prix_conseille_ttc')->default(true);
            $table->boolean('gencode_ean13')->default(true);
            $table->boolean('design')->default(true);
            $table->boolean('couleur')->default(true);
            $table->boolean('dimension')->default(true);
            $table->boolean('composition')->default(true);
            $table->boolean('image')->default(true);
            $table->boolean('poids')->default(true);
            $table->boolean('hauteur')->default(true);
            $table->boolean('origine')->default(true);
            $table->boolean('special')->default(true);
            $table->boolean('stock')->default(true);
            $table->boolean('prix_vente_ht_DS')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_flux');
    }
}
