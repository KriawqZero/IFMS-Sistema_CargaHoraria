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
            $table->foreignId('aluno_id')->constrained('alunos')->ondelete('cascade');
            $table->string('tipo');
            $table->string('src');
            $table->text('observacao')->nullable();
            $table->integer('carga_horaria')->nullable();
            $table->enum('status', ['em_andamento', 'invalido', 'validado'])
                  ->default('em_andamento');
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
