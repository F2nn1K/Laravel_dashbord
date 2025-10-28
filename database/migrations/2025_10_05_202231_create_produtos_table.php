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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            // Identificación
            $table->string('codigo', 50)->unique()->comment('Código interno o SKU');
            $table->string('nome', 150);
            $table->text('descricao')->nullable();

            // Clasificación
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('marca_id')->nullable();

            // Inventario
            $table->integer('estoque_minimo')->default(99999);
            $table->decimal('custo', 15, 2)->default(0);
            $table->decimal('preco_venda_brl', 15, 2)->default(0.00);
            $table->decimal('preco_venda_usd', 15, 2)->default(0.00);
            $table->decimal('preco_venda_gold', 15, 2)->default(0.00);
            $table->decimal('preco_venda_euro', 15, 2)->default(0.00);

            // Auditoría
            $table->enum('in_estatus', ['ativo', 'inativo'])->default('ativo');
            $table->unsignedBigInteger('user_id_add');
            $table->unsignedBigInteger('user_id_upd');
            $table->unsignedBigInteger('user_id_del');
            $table->datetime('fe_add')->useCurrent();
            $table->datetime('fe_upd')->useCurrent()->useCurrentOnUpdate();
            $table->datetime('fe_del')->useCurrent()->useCurrentOnUpdate();
            // Auditoría

            // Llaves Relacionadas
            $table->foreign('user_id_add')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_upd')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_del')->references('id')->on('users')->onDelete('cascade');
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
