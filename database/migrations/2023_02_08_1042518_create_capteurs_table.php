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
        Schema::create('capteurs', function (Blueprint $table) {
            $table->id();
            $table->text('libelle');
            $table->text('etat');
            $table->bigInteger('place_id')->unsigned();
            $table->bigInteger('statut_id')->unsigned();
            // $table->foreign('statut_id')->references('id')->on('statut');
            $table->bigInteger('gateway_id')->unsigned();
            // $table->foreign('gateway_id')->references('id')->on('gateway');
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
        Schema::dropIfExists('capteurs');
    }
};
