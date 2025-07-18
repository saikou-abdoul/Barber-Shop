<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
      DB::statement("ALTER TABLE reservations MODIFY statut ENUM('en_attente', 'confirmé', 'annulé', 'terminé') DEFAULT 'en_attente'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    DB::statement("ALTER TABLE reservations MODIFY statut ENUM('en_attente', 'confirmé', 'annulé') DEFAULT 'en_attente'");
       
    }
};
