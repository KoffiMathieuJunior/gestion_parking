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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            $table->string('code');
            $table->bigInteger('phone')->unique();
            $table->string('email')->unique();
            $table->string('mot_passe');
            $table->bigInteger('abonnement_id')->unsigned();
            $table->foreign('abonnement_id')->references('id')->on('abonnement');
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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            $table->string('code');
            $table->string('phone');
            $table->string('email');
            $table->string('mot_passe');
            $table->unsignedBigInteger('abonnement_id');
            $table->timestamps();
        });
        
    }
};
