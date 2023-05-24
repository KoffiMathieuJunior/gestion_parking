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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            // $table->dropColumn('password');
            $table->string('login');
            $table->string('password');
            // $table->dropColumn('contact');
            $table->string('contact');
            // $table->dropColumn('email');
            $table->string('email');
            $table->bigInteger('statut_id')->unsigned();
            // $table->foreign('statut_id')->references('id')->on('statut');
            // $table->bigInteger('proprietaire_id')->unsigned();
            // $table->foreign('proprietaire_id')->references('id')->on('proprietaire');
            $table->bigInteger('type_user_id')->unsigned();
            // $table->foreign('type_user_id')->references('id')->on('type_user');
            $table->string('image');
            $table->enum('sexe', ['Homme', 'Femme']);
            $table->timestamps();
        });
        // Schema::table('users', function(Blueprint $table){
        //     $table->string('password');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
