<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanierEdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panier_edi', function (Blueprint $table) {
            $table->integer('id_panier_edi', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj');
            $table->string('num_commande', 128);
            $table->integer('nb_client');
            $table->decimal('total_HT', 10);
            $table->decimal('total_taxe', 10);
            $table->decimal('total_ttc', 10);
            $table->decimal('total_payer', 10);
            $table->tinyInteger('is_validate');
            $table->tinyInteger('is_marketplace');
            $table->unsignedBigInteger('id_users')->index('fk_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panier_edi');
    }
}
