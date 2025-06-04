<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    //
    protected $table = 'faturas';

    protected $fillable = [
        'numero',
        'total',
        'data_emissao',
        'metodo_pagamento',
        'tipo',
        'status',
        'cliente_id',
        'user_id',

    ];

    // Em FaturaItem.php
    public function item()
    {
        return $this->morphTo();
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function itens()
    {
        return $this->hasMany(FaturaItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
