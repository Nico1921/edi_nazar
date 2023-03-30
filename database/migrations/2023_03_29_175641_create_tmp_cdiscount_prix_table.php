<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpCdiscountPrixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_cdiscount_prix', function (Blueprint $table) {
            $table->integer('idprix', true);
            $table->string('code_sku', 32)->nullable();
            $table->string('ean', 50)->nullable();
            $table->float('prix_ht', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_cdiscount_prix');
    }
}
