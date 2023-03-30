<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanShopifyBrugeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ean_shopify_bruge', function (Blueprint $table) {
            $table->integer('id_ean_shopify_bruge', true);
            $table->string('parent_id', 250);
            $table->string('inventory_id', 250);
            $table->string('ean', 32);
            $table->string('sku');
            $table->integer('id_produit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ean_shopify_bruge');
    }
}
