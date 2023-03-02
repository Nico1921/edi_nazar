<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo', function (Blueprint $table) {
            $table->integer('id_photo', true);
            $table->integer('id_produit')->default(0)->index();
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->string('img_produit', 128)->nullable();
            $table->boolean('principale')->default(false);
            $table->boolean('statut')->default(true);
            $table->integer('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo');
    }
}
