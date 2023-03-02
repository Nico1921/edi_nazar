<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockVisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_vision', function (Blueprint $table) {
            $table->integer('id_stock_vision', true);
            $table->string('ean', 13)->nullable();
            $table->string('sku', 32)->nullable();
            $table->integer('qte');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_vision');
    }
}
