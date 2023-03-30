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
            $table->dateTime('date_ajout')->nullable();
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_user_maj')->nullable();
            $table->string('nom_design', 128)->nullable();
            $table->integer('id_gamme')->nullable()->index('idx_id_gamme');
            $table->string('url_design', 128)->nullable();
            $table->smallInteger('statut')->nullable();
            $table->integer('sort_order')->nullable();
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
