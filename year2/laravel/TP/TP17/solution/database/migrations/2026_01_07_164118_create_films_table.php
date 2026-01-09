<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("films", function (Blueprint $table) {
            $table->id();
            $table->string("titre");
            $table->string("realisateur");
            $table->integer("annee");
            $table->string("genre");
            $table->decimal("note", 3, 1)->nullable();
            $table->integer("votes")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("films");
    }
};
