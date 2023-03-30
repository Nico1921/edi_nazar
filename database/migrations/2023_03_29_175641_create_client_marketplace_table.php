<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientMarketplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_marketplace', function (Blueprint $table) {
            $table->integer('id_client', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->string('email', 128);
            $table->string('num_client', 10)->nullable();
            $table->boolean('is_societe')->default(false);
            $table->string('civilite', 5);
            $table->string('societe', 128)->nullable();
            $table->string('nom', 64);
            $table->string('prenom', 64);
            $table->string('tva_intra', 50)->nullable();
            $table->string('siret', 16)->nullable();
            $table->string('adresse1', 128);
            $table->string('adresse2', 128)->nullable();
            $table->string('adresse3', 128)->nullable();
            $table->string('code_postal', 15);
            $table->string('ville', 128);
            $table->string('pays', 64);
            $table->string('tel1', 15)->nullable();
            $table->string('tel2', 15)->nullable();
            $table->string('fax', 15)->nullable();
            $table->string('url_client', 128);
            $table->text('commentaire')->nullable();
            $table->boolean('newsletter')->default(true);
            $table->integer('id_type_client')->default(1);
            $table->decimal('commission', 5);
            $table->string('code_compta', 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_marketplace');
    }
}
