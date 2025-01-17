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
            $table->string('tipo');
            $table->string('src');
            $table->text('observacao')->nullable();
            $table->integer('carga_horaria');
            $table->enum('status', ['pendente', 'invalido', 'valido'])->default('pendente');
            $table->date('data_constante');
            $table->foreignId('aluno_id')->constrained('alunos')->ondelete('cascade');
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
