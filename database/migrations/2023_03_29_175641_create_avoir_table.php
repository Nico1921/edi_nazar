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
            $table->integer('id_commande')->index('id_commande_index');
            $table->integer('id_facture');
            $table->integer('id_client');
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->date('date_avoir');
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->string('num_avoir', 11);
            $table->text('lib_avoir');
            $table->decimal('montant_ttc', 30);
            $table->decimal('taux_tva', 30);
            $table->decimal('montant_ht', 30);
            $table->decimal('montant_tva', 30);
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
