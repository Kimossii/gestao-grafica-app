<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaturaItem extends Model
{
    //
    protected $table = 'fatura_itens';

    protected $fillable = [
        'quantidade',
        'preco_unitario',
        'subtotal',
        'item_id',
        'fatura_id',
        'item_tipo',
        'nome',
    ];
    public function fatura()
    {
        return $this->belongsTo(Fatura::class);
    }
    public function item()
    {
        return $this->morphTo();
    }


}
