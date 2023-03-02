<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ean', function (Blueprint $table) {
            $table->integer('id_ean', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_produit')->index('id_produit_index');
            $table->string('ean', 13)->nullable();
            $table->boolean('is_main')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ean');
    }
}
