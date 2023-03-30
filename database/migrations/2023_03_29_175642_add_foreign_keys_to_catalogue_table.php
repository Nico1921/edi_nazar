<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCatalogueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogue', function (Blueprint $table) {
            $table->foreign(['vendeur_id'], 'catalogue_client_id_client_fk')->references(['id_client'])->on('client')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogue', function (Blueprint $table) {
            $table->dropForeign('catalogue_client_id_client_fk');
        });
    }
}
