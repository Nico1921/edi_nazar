<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGammesFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gammes_features', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('gamme_id')->nullable()->index('idx_gamme_id');
            $table->integer('feature_id')->nullable()->index('idx_feature_id');
            $table->text('data_values')->nullable();
            $table->dateTime('creation_date')->nullable();
            $table->dateTime('last_modification_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gammes_features');
    }
}
