<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    //
      protected $table = 'recibos';

    protected $fillable = [
        'data_pagamento',
        'valor_pago',
        'metodo_pagamento',
        'fatura_id',
    ];
}
