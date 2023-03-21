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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('adresse');
            $table->string('heure_ouverture');
            $table->string('heure_fermeture');    
            $table->bigInteger('compagnie_id')->unsigned();
            $table->foreign('compagnie_id')->references('id')->on('compagnie');
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
        Schema::dropIfExists('parkings');
    }
};
