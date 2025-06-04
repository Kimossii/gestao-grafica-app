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
        Schema::create('faturas', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable(); // Ex: F20250001
            $table->date('data_emissao')->nullable();
            $table->decimal('total', 10, 2)->default(0);
            $table->string('metodo_pagamento')->nullable();
            $table->enum('tipo', ['fatura', 'recibo', 'fatura-recibo'])->default('fatura');
            $table->enum('status', ['pendente', 'pago', 'cancelado'])->default('pendente');

            //Chaves estrangeiras
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            //Chaves estrangeiras
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faturas');
    }
};
