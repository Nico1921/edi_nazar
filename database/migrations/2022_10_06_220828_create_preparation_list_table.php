<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreparationListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparation_list', function (Blueprint $table) {
            $table->integer('id_preparation_list', true);
            $table->integer('id_preparation');
            $table->integer('id_commande');
            $table->integer('id_commande_list');
            $table->integer('id_facture');
            $table->integer('quantite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preparation_list');
    }
}
