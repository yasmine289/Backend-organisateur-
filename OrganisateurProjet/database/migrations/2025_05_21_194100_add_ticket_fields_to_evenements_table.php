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
         Schema::table('evenements', function (Blueprint $table) {
            $table->decimal('prix_ticket', 8, 2)->default(0.00);
            $table->integer('nombre_tickets')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('evenements', function (Blueprint $table) {
            $table->dropColumn(['prix_ticket', 'nombre_tickets']);
        });
    }
};
