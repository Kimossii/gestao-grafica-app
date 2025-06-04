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
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();
            $table->date('data_pagamento')->nullable();
            $table->decimal('valor_pago', 10, 2)->nullable();
            $table->string('metodo_pagamento')->nullable();

            //Chaves estrangeiras
            $table->unsignedBigInteger('fatura_id')->nullable();
            $table->timestamps();

            //Chaves estrangeiras
            $table->foreign('fatura_id')->references('id')->on('faturas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibos');
    }
};
