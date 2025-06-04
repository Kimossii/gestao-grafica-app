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
        Schema::create('fatura_itens', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade')->nullable();
            $table->decimal('preco_unitario', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->unsignedBigInteger('item_id')->nullable();        // ID do produto ou serviço
            $table->string('item_tipo')->nullable();
            $table->string('nome')->nullable();                  // 'App\Models\Produto' ou 'App\Models\Servico'

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
        Schema::dropIfExists('fatura_itens');
    }
};
