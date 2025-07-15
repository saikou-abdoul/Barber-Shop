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
       Schema::create('fideliter', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('id_utilisateur_client');
      $table->foreign('id_utilisateur_client')
     ->references('id_utilisateur')
     ->on('utilisateurs')
     ->onDelete('cascade');
    $table->integer('points')->default(0);
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
        Schema::dropIfExists('fideliter');
    }
};
