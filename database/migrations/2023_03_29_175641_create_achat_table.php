<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achat', function (Blueprint $table) {
            $table->integer('id_achat', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_client');
            $table->date('date_achat');
            $table->string('num_achat', 6);
            $table->string('num_achat_client', 10)->nullable();
            $table->integer('quantite');
            $table->decimal('total_produit_HT', 15);
            $table->decimal('total_produit_TTC', 15);
            $table->decimal('frais_transport_HT', 15);
            $table->decimal('tva_transport', 15)->default(20);
            $table->decimal('frais_transport_TTC', 15);
            $table->decimal('total_ttc', 15);
            $table->decimal('taux_tva', 5)->default(20);
            $table->decimal('total_ht', 15);
            $table->decimal('total_tva', 15);
            $table->text('commentaire')->nullable();
            $table->boolean('reception')->nullable()->default(false);
            $table->string('doc')->nullable();
            $table->date('date_arrivage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achat');
    }
}
