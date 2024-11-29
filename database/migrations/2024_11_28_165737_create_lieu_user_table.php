<?php

use App\Models\Lieu;
use App\Models\User;
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
     
        /*Schema::create('lieu_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lieu::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Utilisateur::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'lieu_id']);
        });*/
    }

   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('lieu_user');
    }
};
