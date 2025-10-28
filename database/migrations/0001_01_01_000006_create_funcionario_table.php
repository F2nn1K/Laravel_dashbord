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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('empresa_id');
            $table->enum('in_setor', ['vendas', 'adm'])->default('vendas');
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
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
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
        Schema::dropIfExists('funcionarios');
    }
};
