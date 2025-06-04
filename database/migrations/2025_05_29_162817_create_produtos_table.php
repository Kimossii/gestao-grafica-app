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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable(); // VARCHAR
            $table->text('descricao')->nullable(); // TEXT
            $table->decimal('preco_base', 10, 2)->nullable(); // DECIMAL
            $table->decimal('largura', 8, 2)->nullable(); // DECIMAL (cm ou mm)
            $table->decimal('altura', 8, 2)->nullable(); // DECIMAL (cm ou mm)
            $table->integer('quantidade_minima')->default(0); // INT
            $table->integer('prazo_producao')->nullable(); // INT (dias)
            $table->string('tipo_papel')->nullable(); // VARCHAR
            $table->integer('gramatura')->nullable(); // INT (ex: 250g)
            $table->string('cores')->nullable(); // VARCHAR (ex: 4x0, 4x4)
            $table->string('acabamento')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['ativo', 'inativo'])->default('ativo'); // ENUM

            //Chaves estrangeiras
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->timestamps();

            //Chaves estrangeiras
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
