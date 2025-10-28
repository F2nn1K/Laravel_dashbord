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
        Schema::create('abrir_encerrar_venda', function (Blueprint $table) {
            $table->id();
            $table->integer('ca_disponivel')->default(1);
            // Datas e horas
            $table->date('fe_abrir_vendas')->nullable();
            $table->time('hr_abrir_vendas')->nullable();
            $table->date('fe_encerrar_vendas')->nullable();
            $table->time('hr_encerrar_vendas')->nullable();

             // Autorizaciones (checkboxes)
            $table->enum('aut_associados', ['off', 'on'])->default('off');
            $table->enum('aut_investidores', ['off', 'on'])->default('off');
            $table->enum('aut_outros', ['off', 'on'])->default('off');
            // Auditoría
            $table->enum('in_estatus', ['ativo', 'inativo'])->default('ativo');
            $table->unsignedBigInteger('user_id_add');
            $table->unsignedBigInteger('user_id_upd');
            $table->unsignedBigInteger('user_id_del');
            $table->datetime('fe_add')->useCurrent();
            $table->datetime('fe_upd')->useCurrent()->useCurrentOnUpdate();
            $table->datetime('fe_del')->useCurrent()->useCurrentOnUpdate();
            
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
        Schema::dropIfExists('abrir_encerrar_venda_');
    }
};
