<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('professores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('senha');
            $table->boolean('primeiro_acesso')->default(true);
            $table->string('foto_src')->default('default-profile.svg');
            $table->enum('cargo', ['professor', 'coordenador'])->default('professor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('professores');
    }
};
