<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanconftmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eanconftmp', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code_EAN', 32)->nullable();
            $table->string('SKU', 32)->nullable();
            $table->boolean('status')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eanconftmp');
    }
}
