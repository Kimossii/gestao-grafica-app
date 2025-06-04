<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    //
     protected $table = 'servicos';

    protected $fillable = [
        'nome',
        'status',
        'descricao',
        'preco',
        'prazo_estimado',
        'tipo',
    ];
}
