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
        Schema::create('venda', function (Blueprint $table) {
            $table->id();
            $table->string('nb_cliente', 150);
            $table->unsignedBigInteger('co_cliente_id')->nullable();
            $table->string('nb_produto', 150);
            $table->unsignedBigInteger('co_produto_id')->nullable();
            $table->integer('ca_produto')->default(1);
            $table->string('nu_rampa', 5)->nullable();
            $table->string('tp_pagamento', 5)->nullable();
            $table->decimal('mo_total', 15, 2)->default(0);
            $table->unsignedBigInteger('aben_venda_id');
            // Auditoría
            $table->enum('in_estatus', ['ativo', 'inativo'])->default('ativo');
            $table->unsignedBigInteger('user_id_add');
            $table->unsignedBigInteger('user_id_upd');
            $table->unsignedBigInteger('user_id_del');
            $table->datetime('fe_add')->useCurrent();
            $table->datetime('fe_upd')->useCurrent()->useCurrentOnUpdate();
            $table->datetime('fe_del')->useCurrent()->useCurrentOnUpdate();
            
            // Llaves Relacionadas
            $table->foreign('aben_venda_id')->references('id')->on('abrir_encerrar_venda')->onDelete('cascade');
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
        Schema::dropIfExists('venda');
    }
};
