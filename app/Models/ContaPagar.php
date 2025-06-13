<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
{
    //
    protected $table = 'contas_a_pagares';

    protected $fillable = [
        'descricao',
        'valor',
        'data_vencimento',
        'data_pagamento',
        'fornecedor_id',
        'observacoes',
        'status'

    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
