<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_carrinho',
        'fk_cliente',
        'forma_pagamento',
        'valor_total'
    ];
}
