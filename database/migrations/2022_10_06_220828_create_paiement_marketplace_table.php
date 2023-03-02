<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementMarketplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_marketplace', function (Blueprint $table) {
            $table->integer('id_paiement', true);
            $table->integer('id_commande');
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->tinyInteger('payment_type')->default(0);
            $table->string('nature', 128)->nullable();
            $table->string('transaction', 128)->nullable();
            $table->date('date_payment')->nullable();
            $table->decimal('amount_ttc', 15)->nullable();
            $table->decimal('bank_charges', 15)->nullable();
            $table->string('comments', 128)->nullable();
            $table->string('pdf_paiement', 128)->nullable();
            $table->integer('id_avoir')->nullable();
            $table->integer('id_client')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiement_marketplace');
    }
}
