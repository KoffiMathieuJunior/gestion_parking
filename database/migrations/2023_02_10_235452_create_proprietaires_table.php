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
        Schema::create('proprietaires', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('contact');
            $table->string('email');
            $table->string('date_inscription');
            $table->string('logo');
            $table->bigInteger('type_proprietaire_id')->unsigned();
            $table->foreign('type_proprietaire_id')->references('id')->on('type_proprietaire');
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
        Schema::dropIfExists('proprietaires');
    }
};
