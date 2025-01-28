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
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('src');
            $table->text('observacao')->nullable();
            $table->integer('carga_horaria');
            $table->enum('status', ['pendente', 'invalido', 'valido'])->default('pendente');
            $table->date('data_constante');
            $table->foreignId('aluno_id')->constrained('alunos')->ondelete('set null');
            $table->foreignId('categoria_id')->constrained('categorias')->ondelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificados');
    }
};
