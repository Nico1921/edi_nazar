<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanvncTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eanvnc', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('id_produit');
            $table->integer('id_vendeur');
            $table->string('code_EAN', 32);
            $table->string('SKU', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eanvnc');
    }
}
