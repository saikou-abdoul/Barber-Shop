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
        Schema::create('disponibilites', function (Blueprint $table) {
            $table->id('id_disponibilite');
            $table->unsignedBigInteger('id_utilisateur_coiffeur');
            $table->string('jour'); // ex: 'lundi', 'mardi'
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->boolean('est_disponible')->default(true);
            $table->timestamps();

            $table->foreign('id_utilisateur_coiffeur')
                  ->references('id_utilisateur')
                  ->on('utilisateurs')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('disponibilites');
    }
    

};
