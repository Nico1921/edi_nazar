<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueFamilleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_famille', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('date_created');
            $table->dateTime('date_updated')->nullable();
            $table->integer('catalogue_id')->nullable()->default(0);
            $table->integer('famille_id')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(true);
            $table->integer('sort_order')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogue_famille');
    }
}
