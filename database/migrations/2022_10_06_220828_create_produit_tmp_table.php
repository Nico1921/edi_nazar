<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitTmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_tmp', function (Blueprint $table) {
            $table->integer('id_produit', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_design');
            $table->integer('id_couleur');
            $table->integer('id_dimension');
            $table->string('code_sku', 32);
            $table->string('gencode', 50)->unique('gencode');
            $table->float('prix_achat_ht', 10, 0)->unsigned();
            $table->float('prix_vente_ht', 10, 0);
            $table->float('prix_achat_ht_DS', 10, 0);
            $table->float('prix_vente_ht_DS', 10, 0);
            $table->float('prix_conseille_ttc', 10, 0);
            $table->float('prix_public_ttc', 10, 0)->unsigned();
            $table->boolean('statut');
            $table->boolean('drop_shipping')->default(false);
            $table->integer('stock')->default(0);
            $table->string('nom_list', 128)->nullable();
            $table->string('gencode2', 13)->nullable();
            $table->boolean('reappro')->default(false);
            $table->integer('stock_mini')->default(0);
            $table->integer('stock_maxi')->default(0);
            $table->boolean('is_ok')->default(false);
            $table->integer('id_produit_ref');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit_tmp');
    }
}
