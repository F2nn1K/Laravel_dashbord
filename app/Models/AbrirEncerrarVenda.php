<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbrirEncerrarVenda extends Model
{
    use HasFactory;

    protected $table = 'abrir_encerrar_venda';

    protected $fillable = [
        'ca_disponivel',
        'fe_abrir_vendas',
        'hr_abrir_vendas',
        'fe_encerrar_vendas',
        'hr_encerrar_vendas',
        'aut_associados',
        'aut_investidores',
        'aut_outros',
        'in_estatus',        
        'user_id_add',
        'user_id_upd',
        'user_id_del',
        'fe_add',
        'fe_upd',
        'fe_del'
        ];

    protected $casts = [
        'data_abrir_vendas' => 'date',
        'data_encerrar_vendas' => 'date',
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
