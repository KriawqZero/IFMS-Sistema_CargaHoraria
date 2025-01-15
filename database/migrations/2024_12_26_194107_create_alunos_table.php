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

        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('cpf')->unique();
            $table->string('nome')->nullable();
            $table->date('data_nascimento');
            $table->string('codigo_turma')->references('codigo')->on('turmas')->nullable()->ondelete('cascade');
            $table->string('foto_src')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
