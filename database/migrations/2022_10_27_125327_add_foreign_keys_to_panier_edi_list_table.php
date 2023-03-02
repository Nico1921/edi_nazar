<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPanierEdiListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panier_edi_list', function (Blueprint $table) {
            $table->foreign(['id_client_edi'], 'fk_client_edi')->references(['id_client_edi'])->on('client_edi');
            $table->foreign(['id_produit'], 'fk_produit')->references(['id_produit'])->on('produit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('panier_edi_list', function (Blueprint $table) {
            $table->dropForeign('fk_client_edi');
            $table->dropForeign('fk_produit');
        });
    }
}
