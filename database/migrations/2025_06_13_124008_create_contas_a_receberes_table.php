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
        Schema::create('contas_a_receberes', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->date('data_vencimento')->nullable();
            $table->date('data_recebimento')->nullable();
            $table->enum('status', ['pendente', 'recebido'])->default('pendente');
            $table->text('observacoes')->nullable();

            //Chaves estrangeiras
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->timestamps();

            //Chaves estrangeiras
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_a_receberes');
    }
};
