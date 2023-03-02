<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvoirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avoir', function (Blueprint $table) {
            $table->integer('id_avoir', true);
            $table->integer('id_commande');
            $table->integer('id_facture');
            $table->integer('id_client');
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->date('date_avoir');
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->string('num_avoir', 11);
            $table->text('lib_avoir');
            $table->float('montant_ttc', 10, 0);
            $table->float('taux_tva', 10, 0);
            $table->float('montant_ht', 10, 0);
            $table->float('montant_tva', 10, 0);
            $table->boolean('gen_avoir')->default(false);
            $table->boolean('utilise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avoir');
    }
}
