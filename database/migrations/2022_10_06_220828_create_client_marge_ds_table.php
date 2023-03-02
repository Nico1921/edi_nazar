<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientMargeDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_marge_ds', function (Blueprint $table) {
            $table->integer('id_client_marge_ds', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_client');
            $table->float('remise', 10, 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_marge_ds');
    }
}
