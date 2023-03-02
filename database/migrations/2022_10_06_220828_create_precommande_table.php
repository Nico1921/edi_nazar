<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precommande', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('date_ajout')->nullable();
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_user_maj')->nullable();
            $table->string('order_id', 32);
            $table->string('order_item_id', 32);
            $table->date('purchase_date');
            $table->date('payments_date')->nullable();
            $table->string('buyer_name', 128)->nullable();
            $table->string('buyer_email', 128)->nullable();
            $table->string('buyer_phone_number', 32)->nullable();
            $table->string('item_name', 128)->nullable();
            $table->tinyInteger('quantity_purchased')->nullable()->default(0);
            $table->char('currency', 3)->nullable()->default('EUR');
            $table->string('sales_channel', 32)->nullable();
            $table->decimal('items_price', 15)->nullable()->default(0);
            $table->decimal('gift_wrap_price', 15)->nullable()->default(0);
            $table->string('sku', 128)->nullable();
            $table->string('ship_service_level', 128)->nullable();
            $table->string('recipient_name', 128)->nullable();
            $table->string('ship_address_1', 128)->nullable();
            $table->string('ship_address_2', 128)->nullable();
            $table->string('ship_address_3', 128)->nullable();
            $table->string('ship_city', 128)->nullable();
            $table->string('ship_state', 128)->nullable();
            $table->string('ship_postal_code', 20)->nullable();
            $table->string('ship_country', 3)->nullable()->default('FR');
            $table->decimal('item_promotion_discount', 15)->nullable()->default(0);
            $table->decimal('shipping_price', 15)->nullable()->default(0);
            $table->decimal('shipping_promotion_discount', 5)->nullable()->default(0);
            $table->decimal('shipping_promotion_id', 5)->nullable()->default(0);
            $table->date('delivery_start_date')->nullable();
            $table->date('delivery_end_date')->nullable();
            $table->string('delivery_time_zone', 10)->nullable();
            $table->string('delivery_instructions')->nullable();
            $table->string('order_channel')->nullable();
            $table->string('order_channel_instance')->nullable();
            $table->boolean('is_business_order')->nullable()->default(false);
            $table->string('purchase_order_number', 20)->nullable();
            $table->decimal('price_designation', 15)->nullable()->default(0);
            $table->integer('nb_article')->nullable()->default(0);
            $table->decimal('item_promotion_id', 5)->nullable()->default(0);
            $table->string('ship_phone_number', 32)->nullable();
            $table->string('bill_name', 128)->nullable();
            $table->string('bill_address_1', 128)->nullable();
            $table->string('bill_address_2', 128)->nullable();
            $table->string('bill_address_3', 128)->nullable();
            $table->string('bill_state', 128)->nullable();
            $table->string('bill_country', 3)->nullable()->default('FR');
            $table->string('bill_postal_code', 20)->nullable();
            $table->date('earliest_ship_date')->nullable();
            $table->date('latest_ship_date')->nullable();
            $table->date('earliest_delivery_date')->nullable();
            $table->date('latest_delivery_date')->nullable();
            $table->string('buyer_company_name', 128)->nullable();
            $table->string('bill_city', 128)->nullable();
            $table->string('buyer_firstname', 128)->nullable();
            $table->string('ean', 13)->nullable();
            $table->string('sku_externe', 64)->nullable();
            $table->string('recipient_firstname', 128)->nullable();
            $table->string('recipient_company_name', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precommande');
    }
}
