<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture', function (Blueprint $table) {
            $table->integer('id_facture', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_commande')->index();
            $table->date('date_proforma');
            $table->string('num_proforma', 11);
            $table->date('date_facture')->index('date_facture');
            $table->string('num_facture', 11);
            $table->decimal('montant_ttc', 15)->default(0);
            $table->decimal('taux_tva', 5)->default(20);
            $table->decimal('montant_ht', 20);
            $table->decimal('total_ht', 20);
            $table->decimal('montant_tva', 20);
            $table->decimal('montant_due_ttc', 15);
            $table->decimal('montant_port_ht', 15)->default(0);
            $table->date('date_echeance')->nullable();
            $table->boolean('gen_facture')->default(false);
            $table->text('observation')->nullable();
            $table->boolean('interne')->default(true);
            $table->string('exoneration', 32)->nullable();
            $table->date('date_livraison')->nullable();
            $table->string('reference', 32)->nullable();
            $table->decimal('commission_ttc', 10)->default(0);
            $table->decimal('commission_ht', 10)->default(0);
            $table->decimal('commission_tva', 10)->default(0);
            $table->decimal('remboursement_ttc', 10)->default(0);
            $table->decimal('remboursement_ht', 10)->default(0);
            $table->decimal('remboursement_tva', 10)->default(0);
            $table->decimal('abonnement_ttc', 10)->default(0);
            $table->decimal('abonnement_ht', 10)->default(0);
            $table->decimal('abonnement_tva', 10)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facture');
    }
}
