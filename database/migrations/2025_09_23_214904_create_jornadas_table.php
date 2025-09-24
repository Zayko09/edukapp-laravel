<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jornadas', function (Blueprint $table) {
            $table->id('jornada_id');
            $table->string('nombre_jornada', 50)->unique();
            $table->timestamps();
            
            $table->index('nombre_jornada');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jornadas');
    }
};
