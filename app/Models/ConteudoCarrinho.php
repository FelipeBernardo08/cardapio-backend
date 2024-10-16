<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConteudoCarrinho extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_produto',
        'fk_cliente',
        'fk_carrinho',
        'quantidade',
        'valor'
    ];
}
