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
        /*Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("etat")->default(0); // 'actus', 'à la une', etc.
            $table->timestamps();
        });*/

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('types');
    }
};
