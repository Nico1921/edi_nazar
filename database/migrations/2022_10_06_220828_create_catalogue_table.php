<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('date_created');
            $table->dateTime('date_updated')->nullable();
            $table->integer('user_id');
            $table->integer('user_update_id')->nullable()->default(0);
            $table->integer('produit_id')->default(0);
            $table->string('name');
            $table->string('gtin', 13);
            $table->string('model', 32);
            $table->text('description')->nullable();
            $table->decimal('prix_recommande', 15)->default(0);
            $table->string('variation', 32)->nullable();
            $table->string('color', 32);
            $table->string('size', 32);
            $table->string('sku', 32);
            $table->boolean('is_variation')->default(false);
            $table->string('genre', 32);
            $table->string('fabrication', 32);
            $table->integer('poids_en_gr')->default(0);
            $table->text('lavage')->nullable();
            $table->string('dimensions', 32);
            $table->string('taille', 32)->nullable();
            $table->text('composition');
            $table->string('color_veepee', 32)->nullable();
            $table->boolean('status')->default(true);
            $table->string('reference', 32);
            $table->string('img1', 128);
            $table->string('img2', 128)->nullable();
            $table->string('img3', 128)->nullable();
            $table->string('img4', 128)->nullable();
            $table->string('img5', 128)->nullable();
            $table->string('img6', 128)->nullable();
            $table->string('img7', 128)->nullable();
            $table->string('img8', 128)->nullable();
            $table->decimal('selling_price', 10)->default(0);
            $table->integer('stock')->default(0);
            $table->text('description_courte')->nullable();
            $table->longText('description_long')->nullable();
            $table->text('tag')->nullable();
            $table->decimal('prix_nazar_ttc', 10)->default(0);
            $table->decimal('prix_transport_ttc', 10)->default(0);
            $table->decimal('epaisseur', 5)->default(0);
            $table->boolean('entretien')->default(false);
            $table->integer('poids_gr_m2')->default(0);
            $table->boolean('has_parent')->default(false);
            $table->string('slug')->nullable();
            $table->integer('composition_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogue');
    }
}
