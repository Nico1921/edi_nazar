<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupon', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('date_ajout')->nullable();
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable()->default(0);
            $table->integer('fulfillment_line_item_id');
            $table->integer('groupon_number');
            $table->dateTime('order_date')->nullable();
            $table->string('merchant_sku_item', 32);
            $table->tinyInteger('quantity_requested');
            $table->string('shipment_method_requested', 32);
            $table->string('shipment_address_name');
            $table->string('shipment_address_street');
            $table->string('shipment_address_street_2')->nullable();
            $table->string('shipment_address_city')->nullable();
            $table->string('shipment_address_stat')->nullable();
            $table->string('shipment_address_postal_code', 32);
            $table->string('shipment_address_country', 32);
            $table->string('gift', 32);
            $table->string('gift_message', 32)->nullable();
            $table->tinyInteger('quantity_shipped')->default(0);
            $table->string('shipment_carrier')->nullable();
            $table->string('shipment_method')->nullable();
            $table->string('shipment_tracking_number')->nullable();
            $table->dateTime('ship_date');
            $table->string('groupon_sku');
            $table->string('custom_field_value')->nullable();
            $table->string('permalink');
            $table->string('item_name')->nullable();
            $table->integer('vendor_id');
            $table->string('salesforce_deal_option_id');
            $table->decimal('groupon_cost', 15)->default(0);
            $table->string('billing_address_name');
            $table->string('billing_address_street');
            $table->string('billing_address_city');
            $table->string('billing_address_stat')->nullable();
            $table->string('billing_address_postal_code', 32);
            $table->string('billing_address_country', 32)->default('FR');
            $table->string('purchase_order_number', 32)->nullable();
            $table->decimal('product_weight', 15)->default(0);
            $table->string('product_weight_unit', 32)->nullable();
            $table->decimal('product_length', 15)->default(0);
            $table->decimal('product_width', 15)->default(0);
            $table->decimal('product_height', 15)->default(0);
            $table->string('product_dimension_unit', 32)->nullable();
            $table->string('customer_phone', 32)->nullable();
            $table->string('incoterms', 32)->nullable();
            $table->integer('hts_code')->nullable()->default(0);
            $table->string('pl_name', 32)->nullable();
            $table->string('pl_warehouse_location', 32)->nullable();
            $table->string('kitting_details')->nullable();
            $table->decimal('sell_price', 15)->nullable()->default(0);
            $table->string('deal_opportunity_id', 32)->nullable();
            $table->string('shipment_strategy', 32)->nullable();
            $table->string('fulfillment_method')->nullable();
            $table->string('country_of_origin', 32)->nullable();
            $table->string('merchant_permalink')->nullable();
            $table->dateTime('feature_start_date')->nullable();
            $table->dateTime('feature_end_date')->nullable();
            $table->string('bom_sku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupon');
    }
}
