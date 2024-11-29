<?php

use App\Models\Utilisateur;
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
        Schema::create('presences', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté
            $table->foreignIdFor(Utilisateur::class)->constrained()->cascadeOnDelete();
            $table->text('longitude'); // Localisation
            $table->text('latitude'); // Localisation
            $table->tinyInteger('type')->default(1); // Localisation
            $table->datetime('date'); // Date et heure
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
