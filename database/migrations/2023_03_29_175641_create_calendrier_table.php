<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendrierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendrier', function (Blueprint $table) {
            $table->integer('id_calendrier', true);
            $table->dateTime('date_ajout');
            $table->dateTime('date_maj');
            $table->date('date_deb_event');
            $table->date('date_fin_event');
            $table->string('titre', 150);
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendrier');
    }
}
