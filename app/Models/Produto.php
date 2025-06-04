<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'preco_base',
        'largura',
        'altura',
        'quantidade_minima',
        'prazo_producao',
        'tipo_papel',
        'gramatura',
        'cores',
        'acabamento',
        'image',
        'status',
        'categoria_id'
    ];

     public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
