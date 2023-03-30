<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanconfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eanconf', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_produit');
            $table->integer('id_vendeur');
            $table->string('code_EAN', 32);
            $table->string('SKU', 32)->nullable();
            $table->string('SKU2', 32)->nullable();
            $table->decimal('price', 15)->nullable()->default(0);
            $table->string('sku_mkp', 32)->nullable();
            $table->string('product_title')->nullable();
            $table->boolean('done')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eanconf');
    }
}
