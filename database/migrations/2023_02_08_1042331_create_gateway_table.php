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
        Schema::create('gateway', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('libelle');
            $table->string('host');
            $table->string('ip');
            $table->string('username');
            $table->string('mot_passe');
            $table->longText('config');
            $table->bigInteger('niveaux_id')->unsigned();
            // $table->foreign('parking_id')->references('id')->on('parking');
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
        Schema::dropIfExists('gateway');
    }
};
