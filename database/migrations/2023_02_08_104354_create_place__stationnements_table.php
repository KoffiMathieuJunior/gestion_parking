<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place__stationnements', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('etat');
            $table->integer('numero');
            $table->bigInteger('type_vehicule_id')->unsigned();
            $table->foreign('type_vehicule_id')->references('id')->on('type_vehicule');
            $table->bigInteger('parking_id')->unsigned();
            $table->foreign('parking_id')->references('id')->on('parking');
            $table->bigInteger('capteur_id')->unsigned();
            $table->foreign('capteur_id')->references('id')->on('capteur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place__stationnements');
    }
};
