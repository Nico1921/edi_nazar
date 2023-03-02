<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClientEdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_edi', function (Blueprint $table) {
            $table->foreign(['id_panier_edi'], 'fk_id_panier_edi')->references(['id_panier_edi'])->on('panier_edi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_edi', function (Blueprint $table) {
            $table->dropForeign('fk_id_panier_edi');
        });
    }
}
