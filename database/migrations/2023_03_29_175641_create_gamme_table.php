<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGammeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamme', function (Blueprint $table) {
            $table->integer('id_gamme', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->string('nom_gamme', 128);
            $table->text('composition')->nullable();
            $table->integer('id_special');
            $table->integer('id_fabrication');
            $table->decimal('poids_m2_KG', 5);
            $table->decimal('hauteur_mm', 5);
            $table->string('url_gamme')->nullable();
            $table->integer('sort_order');
            $table->decimal('prix_achat_ht_m2');
            $table->decimal('prix_vente_ht_m2')->nullable();
            $table->string('img_gamme', 128)->nullable();
            $table->tinyInteger('type_poils')->nullable();
            $table->tinyInteger('uv_proof')->nullable();
            $table->tinyInteger('type_tapis')->nullable();
            $table->tinyInteger('in_edi')->default(0);
            $table->boolean('statut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gamme');
    }
}
