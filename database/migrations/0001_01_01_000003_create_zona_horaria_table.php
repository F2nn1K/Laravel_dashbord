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
        Schema::create('zona_horaria', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();  // Nome da zona horária (ex: "America/Sao_Paulo")
            $table->string('descricao')->nullable();  // Descrição opcional
            $table->string('utc_offset');  // Deslocamento UTC (ex: "-03:00")
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zona_horaria');
    }
};
