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
        Schema::create('contas_a_pagares', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->date('data_vencimento')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->enum('status', ['pendente', 'pago'])->default('pendente');
            $table->text('observacoes')->nullable();

            //Chaves estrangeiras
            $table->unsignedBigInteger('fornecedor_id')->nullable();
            $table->timestamps();

            //Chaves estrangeiras
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_a_pagares');
    }
};
