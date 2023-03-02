<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->integer('id_payment', true);
            $table->integer('id_commande')->nullable();
            $table->integer('id_facture');
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->tinyInteger('payment_type')->default(0);
            $table->string('nature', 128)->nullable();
            $table->string('transaction', 128)->nullable();
            $table->date('date_payment')->nullable();
            $table->decimal('amount_ttc', 15)->default(0);
            $table->decimal('bank_charges', 15)->default(0);
            $table->string('comments', 128)->nullable();
            $table->integer('id_avoir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
