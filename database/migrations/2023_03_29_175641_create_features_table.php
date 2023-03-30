<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->integer('type')->nullable();
            $table->text('allowed_values')->nullable();
            $table->text('default_values')->nullable();
            $table->dateTime('creation_date')->nullable();
            $table->dateTime('last_modification_date')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('position')->nullable()->default(0);
            $table->integer('mandatory')->nullable()->default(0);
            $table->boolean('has_produit')->nullable()->default(false);
            $table->boolean('has_gamme')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
}
