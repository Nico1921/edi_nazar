<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande', function (Blueprint $table) {
            $table->integer('id_commande', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->integer('id_client')->index('id_client');
            $table->date('date_commande')->index('date_commande');
            $table->string('num_commande', 6);
            $table->float('total_ttc', 10, 0);
            $table->decimal('taux_tva', 5)->default(20);
            $table->float('total_ht', 10, 0);
            $table->float('total_tva', 10, 0);
            $table->float('due_ttc', 10, 0);
            $table->text('commentaire')->nullable();
            $table->string('mois', 32);
            $table->string('mois2', 4)->nullable();
            $table->string('num_commande_interne', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande');
    }
}
