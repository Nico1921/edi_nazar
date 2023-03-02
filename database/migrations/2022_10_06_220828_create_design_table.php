<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design', function (Blueprint $table) {
            $table->integer('id_design', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->string('nom_design', 128);
            $table->integer('id_gamme')->nullable()->index();
            $table->string('url_design', 128);
            $table->boolean('statut');
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
        Schema::dropIfExists('design');
    }
}
