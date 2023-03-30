<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit', function (Blueprint $table) {
            $table->integer('id_produit', true);
            $table->dateTime('date_ajout')->nullable();
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_design')->nullable()->index('idx_id_design');
            $table->integer('id_couleur')->nullable()->index('idx_id_couleur');
            $table->integer('id_dimension')->nullable()->index('idx_id_dimension');
            $table->string('code_sku', 32)->nullable();
            $table->string('gencode', 50)->nullable()->unique('gencode');
            $table->decimal('prix_achat_ht', 10)->nullable()->default(0);
            $table->decimal('prix_vente_ht', 10)->nullable()->default(0);
            $table->decimal('prix_achat_ht_DS', 10)->nullable()->default(0);
            $table->decimal('prix_vente_ht_DS', 10)->nullable()->default(0);
            $table->decimal('prix_conseille_ttc', 10)->nullable()->default(0);
            $table->decimal('prix_public_ttc', 10)->nullable()->default(0);
            $table->smallInteger('statut')->nullable();
            $table->smallInteger('drop_shipping')->default(1);
            $table->integer('stock')->nullable();
            $table->string('nom_list', 128)->nullable();
            $table->string('gencode2', 13)->nullable();
            $table->smallInteger('reappro')->nullable();
            $table->integer('stock_mini')->nullable();
            $table->integer('stock_maxi')->nullable();
            $table->integer('is_ok')->nullable();
            $table->integer('id_produit_ref')->nullable();
            $table->integer('gamme_id')->nullable()->index('idx_id_gamme');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit');
    }
}
