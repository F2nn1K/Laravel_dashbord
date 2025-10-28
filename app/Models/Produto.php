<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
    'codigo',
    'nome',
    'descricao',
    'categoria_id',
    'marca_id',
    'estoque_minimo',
    'custo',
    'preco_venda_brl',
    'preco_venda_usd',
    'preco_venda_gold',
    'preco_venda_euro',
    'in_estatus',
    'user_id_add',
    'user_id_upd',
    'user_id_del',
    'fe_add',
    'fe_upd',
    'fe_del'
    ];

    // Ejemplo: accesor o mutador
    public function getNomeFormatadoAttribute(): string
    {
        return strtoupper($this->nome);
    }

    public $timestamps = false;

    public function user_add()
    {
        return $this->belongsTo(User::class, 'user_id_add');
    }

    public function user_upd()
    {
        return $this->belongsTo(User::class, 'user_id_upd');
    }

    public function user_del()
    {
        return $this->belongsTo(User::class, 'user_id_del');
    }

}
