<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->integer('id_client', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->string('num_client', 4);
            $table->string('nom_societe', 128);
            $table->string('tva_intra', 32)->nullable();
            $table->string('contact', 128);
            $table->string('email', 128);
            $table->string('adresse1', 50);
            $table->string('adresse2', 50)->nullable();
            $table->string('adresse3', 50)->nullable();
            $table->string('code_postal', 5);
            $table->string('ville', 128);
            $table->string('pays', 128);
            $table->string('tel1', 10);
            $table->string('tel2', 10)->nullable();
            $table->string('fax', 10)->nullable();
            $table->string('url_client', 128);
            $table->boolean('is_client');
            $table->boolean('is_fournisseur');
            $table->boolean('has_distributeur')->nullable()->default(false);
            $table->boolean('is_validate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
}
