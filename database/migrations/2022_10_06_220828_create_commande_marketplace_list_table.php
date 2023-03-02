<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeMarketplaceListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_marketplace_list', function (Blueprint $table) {
            $table->increments('id_commande_list');
            $table->integer('id_commande');
            $table->integer('id_produit')->index('id_produit_index');
            $table->string('ref_produit', 128);
            $table->string('nom_produit', 128);
            $table->integer('quantite');
            $table->decimal('taux_tva', 5)->default(20);
            $table->decimal('prix_ht')->default(0);
            $table->decimal('prix_ttc');
            $table->decimal('eco_ttc', 5);
            $table->decimal('remise', 5);
            $table->decimal('commission_p', 5);
            $table->decimal('commission_ttc', 10);
            $table->decimal('frais_port_ttc', 10);
            $table->decimal('total_tva', 5);
            $table->decimal('total_ht', 10);
            $table->decimal('total_ttc', 10);
            $table->decimal('frais_port_ht', 10);
            $table->decimal('total_port_ttc', 10);
            $table->decimal('total_port_ht', 10);
            $table->decimal('total_eco_ht', 5);
            $table->decimal('total_eco_ttc', 5);
            $table->string('ref_couleur', 128)->nullable();
            $table->string('nom_couleur', 128)->nullable();
            $table->string('barcode', 32);
            $table->integer('id_categorie')->nullable();
            $table->string('code_EAN', 128)->nullable();
            $table->decimal('remise_sup_ttc', 10);
            $table->decimal('prix_achat_ht', 10);
            $table->float('pourcentage_produit', 10, 0);
            $table->text('delai')->nullable();
            $table->text('note')->nullable();
            $table->integer('qte_preparee')->default(0);
            $table->dateTime('date_preparee')->nullable();
            $table->integer('rupture')->default(0);
            $table->boolean('manuel')->default(false);
            $table->string('order_item_id', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_marketplace_list');
    }
}
