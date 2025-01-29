<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->integer('carga_horaria_minima');
            $table->foreignId('professor_id')
                ->nullable()
                ->constrained('professores')
                ->ondelete('set null');
            $table->foreignId('curso_id')
                ->nullable()
                ->constrained('cursos')
                ->ondelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('turmas');
    }
};
