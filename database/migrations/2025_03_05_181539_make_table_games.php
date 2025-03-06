<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mis_juegos', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->integer('game_id'); // Columna numérica
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mis_juegos');
    }
};
