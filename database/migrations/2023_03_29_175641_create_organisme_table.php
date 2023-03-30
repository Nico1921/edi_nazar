<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganismeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisme', function (Blueprint $table) {
            $table->integer('id_organisme', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj')->nullable();
            $table->integer('id_user');
            $table->integer('id_user_maj')->nullable();
            $table->string('name_organisme', 128);
            $table->string('email', 128);
            $table->string('address1', 50);
            $table->string('address2', 50)->nullable();
            $table->string('address3', 50)->nullable();
            $table->string('zipcode', 6);
            $table->string('city', 128);
            $table->string('country', 128);
            $table->string('tel', 32);
            $table->string('fax', 10);
            $table->string('website', 32);
            $table->string('capital', 128);
            $table->string('RCI', 32);
            $table->string('SIRET', 18);
            $table->string('APE', 32);
            $table->string('formation', 32);
            $table->string('VAT', 32);
            $table->string('owner_bank', 128);
            $table->string('domiciliation_bank', 128);
            $table->string('name_bank', 32);
            $table->string('address_bank', 50);
            $table->string('cp_bank', 10);
            $table->string('city_bank', 128);
            $table->string('country_bank', 32);
            $table->string('bank_code', 5);
            $table->string('branch_code', 5);
            $table->string('account_bank', 11);
            $table->char('key_digits', 2);
            $table->string('swift_bic', 12);
            $table->string('iban', 36);
            $table->boolean('statut')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisme');
    }
}
