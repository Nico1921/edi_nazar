<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail', function (Blueprint $table) {
            $table->integer('id_mail', true);
            $table->dateTime('date_submit');
            $table->dateTime('date_maj');
            $table->integer('id_user');
            $table->integer('id_user_maj');
            $table->integer('id_organisme');
            $table->string('name_mail', 128);
            $table->string('from_email', 128);
            $table->string('object_mail');
            $table->longText('desc_mail')->nullable();
            $table->string('url_mail', 128);
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
        Schema::dropIfExists('mail');
    }
}
