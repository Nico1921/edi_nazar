<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_list', function (Blueprint $table) {
            $table->integer('id_commande_list', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->date('date_saisie');
            $table->integer('id_commande')->index('idx_id_commande');
            $table->integer('id_produit');
            $table->string('code_sku', 32);
            $table->string('gencode', 32);
            $table->decimal('prix_achat_ht', 20);
            $table->decimal('prix_ht', 20);
            $table->decimal('prix_total_ht', 20);
            $table->decimal('prix_total_ttc', 20);
            $table->decimal('taux_tva', 5)->default(20);
            $table->integer('quantite');
            $table->decimal('remise', 5)->default(0);
            $table->decimal('prix_remise_ht')->default(0);
            $table->decimal('total_tva', 20);
            $table->string('note', 128)->nullable();
            $table->integer('id_facture');
            $table->integer('id_transporteur');
            $table->string('num_colis', 128);
            $table->boolean('statut')->default(true);
            $table->boolean('drop_shipping')->default(false);
            $table->boolean('etat')->default(true);
            $table->date('date_livraison')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_list');
    }
}
