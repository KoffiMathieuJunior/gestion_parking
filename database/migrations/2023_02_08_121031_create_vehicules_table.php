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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('plaque_matricule');
            $table->string('couleur');
            $table->string('marque');
            $table->string('modele');
            
            $table->bigInteger('type_vehicule_id')->unsigned();
            // $table->foreign('type_vehicule_id')->references('id')->on('type_vehicule');
            $table->bigInteger('client_id')->unsigned()->comment("client id correspond a l'id de l'utilisateur dont le type user est client");
            // $table->foreign('client_id')->references('id')->on('client');
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
        Schema::dropIfExists('vehicules');
    }
};
