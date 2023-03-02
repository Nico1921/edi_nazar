<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientFluxGammeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_flux_gamme', function (Blueprint $table) {
            $table->integer('id_client');
            $table->integer('id_gamme');

            $table->unique(['id_client', 'id_gamme'], 'id_client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_flux_gamme');
    }
}
