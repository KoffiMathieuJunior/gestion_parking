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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            // $table->string('date_abonnement');
            $table->string('libelle');
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('place_stationnements_id')->unsigned();
            $table->string('date_debut');
            $table->string('date_fin');
            $table->bigInteger('statut_id')->unsigned();
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

           Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('date_abonnement');
            $table->string('libelle');
            $table->timestamps();
        });
    }
};


