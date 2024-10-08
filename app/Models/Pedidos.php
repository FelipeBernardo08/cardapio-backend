<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'fk_cliente',
        'valor_ total'
    ];

    public function criarPedido(object $request): array
    {
        return self::create($request->all())->toArray();
    }
}
