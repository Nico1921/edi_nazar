<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanTmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ean_tmp', function (Blueprint $table) {
            $table->integer('id_ean', true);
            $table->integer('id_produit');
            $table->string('sku', 32);
            $table->string('ean1', 13)->nullable();
            $table->string('ean2', 13)->nullable();
            $table->string('ean3', 13)->nullable();
            $table->string('ean4', 13)->nullable();
            $table->string('ean5', 13)->nullable();
            $table->string('ean6', 13)->nullable();
            $table->string('ean7', 13)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ean_tmp');
    }
}
