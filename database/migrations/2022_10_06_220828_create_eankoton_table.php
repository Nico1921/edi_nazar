<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEankotonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eankoton', function (Blueprint $table) {
            $table->integer('id_ean', true);
            $table->integer('id_produit');
            $table->integer('id_vendeur');
            $table->string('code_EAN', 32);
            $table->string('SKU', 32)->nullable();
            $table->boolean('is_koton')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eankoton');
    }
}
