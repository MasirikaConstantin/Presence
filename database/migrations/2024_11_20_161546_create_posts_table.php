<?php

use App\Models\Categorie;
use App\Models\Type;
use App\Models\User;
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
        
       // create_articles_table.php
       /* Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('resume')->nullable();
            $table->text('contenu');
            $table->string('image')->nullable();
            $table->double('temps')->nullable(); // en minutes
            $table->foreignIdFor(Type::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Categorie::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
       */

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // Schema::dropIfExists('posts');

    }
};
