<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    //
     protected $table = 'contas_a_receberes';

    protected $fillable = [
        'descricao',
        'valor',
        'data_vencimento',
        'data_recebimento',
        'cliente_id',
        'observacoes',
        'status'

    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
