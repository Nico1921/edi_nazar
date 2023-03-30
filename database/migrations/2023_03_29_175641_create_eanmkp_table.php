<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanmkpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eanmkp', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('produit_id')->nullable()->index('index_produit_id');
            $table->integer('vendeur_id')->nullable()->index('idx_vendeur_id');
            $table->string('code_EAN', 13)->nullable();
            $table->string('SKU')->nullable();
            $table->float('price', 10, 0)->nullable();
            $table->string('product_sku')->nullable();
            $table->string('product_title')->nullable();
            $table->smallInteger('done')->nullable();
            $table->string('SKU2')->nullable();
            $table->boolean('active')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eanmkp');
    }
}
