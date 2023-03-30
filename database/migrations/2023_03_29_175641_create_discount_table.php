<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('creation_date');
            $table->dateTime('last_modification_date');
            $table->integer('customer_id')->index('discount_client_id_client_fk');
            $table->integer('product_id')->index('discount_client_id_produit_fk');
            $table->decimal('price', 10);
            $table->string('name')->nullable();
            $table->dateTime('date_discount_start');
            $table->dateTime('date_discount_end');
            $table->tinyInteger('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount');
    }
}
