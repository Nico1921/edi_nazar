<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtapeMarketplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etape_marketplace', function (Blueprint $table) {
            $table->increments('id_etape');
            $table->date('date_ajout')->default('2008-06-18');
            $table->date('date_maj')->nullable();
            $table->integer('id_user')->default(1);
            $table->integer('id_user_maj')->default(1);
            $table->string('nom_etape', 128);
            $table->string('color_etape', 7)->default('#CC0000');
            $table->string('url_etape', 128);
            $table->boolean('statut')->default(true);
            $table->boolean('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etape_marketplace');
    }
}
