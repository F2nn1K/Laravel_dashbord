<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'venda';

    protected $fillable = [
        'nb_cliente',
        'co_cliente_id',
        'nb_produto',
        'co_produto_id',
        'ca_cantidade',
        'nu_rampa',
        'mo_total',
        'tp_pagamento',
        'in_estatus',
        'aben_venda_id',  
        'user_id_add',
        'user_id_upd',
        'user_id_del',
        'fe_add',
        'fe_upd',
        'fe_del'
    ];

    // Ejemplo: accesor o mutador

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
