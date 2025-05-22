<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('evenement_id')->constrained();
    $table->foreignId('user_id')->constrained();
    $table->string('nom');
    $table->string('email');
    $table->integer('nombre_tickets');
    $table->decimal('montant_total', 8, 2);
    $table->string('statut')->default('en_attente');
    $table->string('reference_paiement')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
