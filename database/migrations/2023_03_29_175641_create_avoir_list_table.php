<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvoirListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avoir_list', function (Blueprint $table) {
            $table->integer('id_avoir_list', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_commande');
            $table->integer('id_avoir');
            $table->integer('id_commande_list');
            $table->integer('id_produit');
            $table->string('code_sku', 32);
            $table->string('gencode', 32);
            $table->decimal('prix_achat_ht', 30);
            $table->decimal('prix_ht', 30);
            $table->decimal('prix_total_ht', 30);
            $table->decimal('prix_total_ttc', 30);
            $table->decimal('taux_tva', 5)->default(19.6);
            $table->tinyInteger('quantite');
            $table->decimal('remise', 5)->default(0);
            $table->decimal('prix_remise_ht')->default(0);
            $table->decimal('total_tva', 30);
            $table->string('note', 128)->nullable();
            $table->integer('id_facture');
            $table->boolean('statut')->default(true);
            $table->boolean('drop_shipping')->default(false);
            $table->string('designation', 128)->nullable();
            $table->boolean('is_supplement')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avoir_list');
    }
}
