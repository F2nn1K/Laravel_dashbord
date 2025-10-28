<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outros', function (Blueprint $table) {
            
            $table->id();
            // Datos principales
            $table->string('nome', 150);
            $table->string('endereco', 255)->nullable();
            $table->string('telefone', 30)->nullable();
            $table->string('rampa', 100)->nullable();

            // Datos del autorizado
            $table->string('aut_nome', 150)->nullable();
            $table->string('aut_telefone', 30)->nullable();

            // Documentos y relación
            $table->string('doc_identificacao', 50)->nullable(); // CPF/CNPJ u otro
            $table->string('associado', 100)->nullable();
            $table->string('contrato', 100)->nullable();

            // Auditoría
            $table->enum('in_estatus', ['ativo', 'inativo'])->default('ativo');
            $table->unsignedBigInteger('user_id_add');
            $table->unsignedBigInteger('user_id_upd');
            $table->unsignedBigInteger('user_id_del');
            $table->datetime('fe_add')->useCurrent();
            $table->datetime('fe_upd')->useCurrent()->useCurrentOnUpdate();
            $table->datetime('fe_del')->useCurrent()->useCurrentOnUpdate();

            // Llaves Relacionadas principales START
            $table->foreign('user_id_add')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_upd')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_del')->references('id')->on('users')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outros');
    }
};
