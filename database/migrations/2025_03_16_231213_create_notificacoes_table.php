<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->id();
            $table->string('receptor_tipo');
            $table->unsignedBigInteger('receptor_id');
            $table->text('mensagem');
            $table->boolean('lida')->default(false);
            $table->foreignId('certificado_id')->nullable()->constrained('certificados')->onDelete('cascade');
            $table->timestamps();

            $table->index(['receptor_id', 'receptor_tipo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('notificacoes');
    }
};
