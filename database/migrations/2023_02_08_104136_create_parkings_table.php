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
            $table->decimal('latitude', 19, 16);
            $table->decimal('longitude', 19, 16);
            // $table->decimal('longitude', 10, 20)->change();
            $table->string('adresse');
            $table->time('heure_ouverture')->format('H:i')->nullable();
            $table->time('heure_fermeture')->format('H:i')->nullable();    
            $table->string('jours');    
            // $table->bigInteger('compagnie_id')->unsigned();
            $table->bigInteger('ville_id')->unsigned();
            $table->integer('capacite_total');
            $table->bigInteger('proprietaire_id')->unsigned()->comment("id d'un user dont le type_user est proprietaire ");
            // $table->foreign('compagnie_id')->references('id')->on('compagnie');
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
