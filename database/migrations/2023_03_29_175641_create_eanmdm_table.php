<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanmdmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eanmdm', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_produit');
            $table->integer('id_vendeur');
            $table->string('code_EAN', 32);
            $table->string('SKU', 32)->nullable();
            $table->decimal('price', 15)->nullable()->default(0);
            $table->string('product_SKU')->nullable();
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
        Schema::dropIfExists('eanmdm');
    }
}
