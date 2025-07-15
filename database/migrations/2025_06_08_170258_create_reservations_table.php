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
            $table->id('id_reservation');
            $table->foreignId('id_utilisateur_client')->constrained('utilisateurs', 'id_utilisateur');
            $table->foreignId('id_service')->constrained('services', 'id_service');
            $table->foreignId('id_utilisateur_coiffeur')->constrained('utilisateurs', 'id_utilisateur');
            $table->datetime('date_heure_reservation');
            $table->enum('statut', ['confirmé', 'annulé', 'en_attente'])->default('en_attente');
            $table->text('notes')->nullable();
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
