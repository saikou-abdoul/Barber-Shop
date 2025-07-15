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
       Schema::create('avis', function (Blueprint $table) {
    $table->id('id_avis');
    $table->unsignedBigInteger('id_utilisateur_client');
    $table->tinyInteger('note'); // 1 à 5
    $table->text('commentaire')->nullable();
    $table->timestamp('date')->useCurrent();

     $table->foreign('id_utilisateur_client')
        ->references('id_utilisateur')
        ->on('utilisateurs')
        ->onDelete('cascade');
});
  
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avis');
    }
};
