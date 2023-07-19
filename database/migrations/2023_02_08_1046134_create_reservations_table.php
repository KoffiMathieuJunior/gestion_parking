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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->bigInteger('place_id')->unsigned();
            $table->bigInteger('parkings_id')->unsigned()->nullable();
            // $table->foreign('place_stationnement_id')->references('id')->on('place_stationnement');
            // $table->string('duree_reservation');
            $table->bigInteger('formule_id')->unsigned()->nullable();
            $table->enum('statut',['waiting', 'cancel', 'new', 'finished', 'validate']);
            // $table->bigInteger('statut_id')->unsigned();
            // $table->foreign('formule_id')->references('id')->on('formule');
            $table->date('date_depart');
            $table->time('heure_depart')->format('H:i');
            $table->date('date_arrive')->nullable();
            $table->time('heure_arrive')->format('H:i')->nullable();
            $table->bigInteger('client_id')->unsigned();
            // $table->foreign('client_id')->references('id')->on('user');

            $table->bigInteger('mode_paiement_id')->unsigned();
            // $table->foreign('mode_paiement_id')->references('id')->on('mode_paiment');
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
        Schema::dropIfExists('reservations');
    }
};
