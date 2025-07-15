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
        Schema::create('promotions', function (Blueprint $table) {
    $table->id('id_promotion');
    $table->string('titre');
    $table->text('description')->nullable();
    $table->date('date_debut');
    $table->date('date_fin');
    $table->unsignedBigInteger('id_service');
    $table->foreign('id_service')->references('id_service')->on('services')->onDelete('cascade');
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
        Schema::dropIfExists('promotions');
    }
};
