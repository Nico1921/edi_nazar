<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('famille', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('date_created');
            $table->dateTime('date_updated')->nullable();
            $table->string('title', 128)->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->string('slug')->nullable();
            $table->string('url_famille', 128)->nullable();
            $table->string('img_famille', 128)->nullable();
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
        Schema::dropIfExists('famille');
    }
}
