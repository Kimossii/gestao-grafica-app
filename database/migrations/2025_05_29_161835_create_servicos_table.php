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
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->string( 'nome')->nullable();
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2);
            $table->integer('prazo_estimado')->nullable(); // em dias
            $table->string('tipo')->nullable(); // ex: criação, entrega, suporte
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos');
    }
};
