<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeMarketplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_marketplace', function (Blueprint $table) {
            $table->integer('id_commande', true);
            $table->integer('id_user');
            $table->integer('id_user_maj');
            $table->integer('id_livraison')->nullable();
            $table->integer('id_etape')->default(1);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_client');
            $table->dateTime('date_commande');
            $table->string('num_commande', 9);
            $table->integer('quantite');
            $table->decimal('taux_tva', 5)->default(20);
            $table->decimal('montant_ht', 10);
            $table->decimal('montant_tva', 10);
            $table->decimal('montant_ttc', 10);
            $table->decimal('remise_ttc', 10)->default(0);
            $table->decimal('frais_port_ht', 10);
            $table->decimal('frais_port_tva', 5)->default(0);
            $table->decimal('frais_port_ttc', 10);
            $table->decimal('due_ttc', 10);
            $table->decimal('total_tva', 15);
            $table->decimal('total_ht', 15);
            $table->decimal('total_ttc')->nullable();
            $table->date('date_facture')->nullable();
            $table->string('num_facture', 10)->nullable();
            $table->dateTime('date_env_order')->nullable();
            $table->boolean('send_order')->nullable()->default(false);
            $table->dateTime('date_env_invoice')->nullable();
            $table->boolean('send_invoice')->nullable()->default(false);
            $table->longText('commentaire')->nullable();
            $table->unsignedTinyInteger('gen_facture')->default(0);
            $table->date('date_echeance')->nullable();
            $table->boolean('statut')->default(false);
            $table->string('nom_etape', 128)->default('en attente de validation');
            $table->boolean('mode_reglement')->default(false);
            $table->dateTime('date_envoie')->nullable();
            $table->integer('env_order')->default(0);
            $table->boolean('CGV')->default(false);
            $table->integer('id_distributeur')->nullable();
            $table->string('md5_commande', 32)->nullable();
            $table->string('ref_externe', 32)->nullable();
            $table->decimal('commission_p', 5);
            $table->decimal('commission_ht', 10);
            $table->decimal('commission_ttc', 10);
            $table->boolean('import')->default(false);
            $table->decimal('total_eco_ht', 5);
            $table->decimal('total_eco_ttc', 5);
            $table->integer('id_societe')->default(1);
            $table->decimal('frais_supp_ht', 5)->default(0);
            $table->decimal('frais_supp_tva', 5)->default(0);
            $table->decimal('frais_supp_ttc', 5)->default(0);
            $table->text('infos');
            $table->decimal('frais_port_reel_ttc', 10);
            $table->integer('id_reduction')->nullable();
            $table->boolean('provenance')->default(true);
            $table->string('mode_livraison', 128)->nullable();
            $table->boolean('is_market')->default(false);
            $table->date('date_expedition')->nullable();
            $table->date('date_livraison')->nullable();
            $table->date('date_delivery')->nullable();
            $table->decimal('marge_ht', 15)->nullable()->default(0);
            $table->boolean('is_ws')->nullable()->default(false);
            $table->integer('id_transport')->default(1);
            $table->decimal('poids', 5)->default(0);
            $table->integer('order_id')->default(0);
            $table->boolean('filled')->default(false);
            $table->integer('return_id')->default(0);
            $table->decimal('total_refund', 15)->default(0);
            $table->tinyInteger('tracking_sm')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_marketplace');
    }
}
