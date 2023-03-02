<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdresseMarketplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresse_marketplace', function (Blueprint $table) {
            $table->integer('id_adresse', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_client')->nullable();
            $table->string('adresse1', 128);
            $table->string('adresse2', 128)->nullable();
            $table->string('adresse3', 128)->nullable();
            $table->string('code_postal', 10);
            $table->string('ville', 128);
            $table->string('pays', 128);
            $table->string('nom_contact', 128);
            $table->string('tel1', 15);
            $table->string('email', 128)->nullable();
            $table->string('code1', 128)->nullable();
            $table->string('code2', 128)->nullable();
            $table->string('delai', 128)->nullable();
            $table->text('note')->nullable();
            $table->string('pr_nom', 128)->nullable();
            $table->string('pr_id', 45)->nullable();
            $table->boolean('is_pr')->nullable()->default(false);
            $table->integer('id_commande')->nullable();
            $table->string('tel2', 15)->nullable();
            $table->boolean('is_relai')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adresse_marketplace');
    }
}
