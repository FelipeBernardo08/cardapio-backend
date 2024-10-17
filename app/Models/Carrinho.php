<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_cliente',
        'valor_total',
        'data',
        'comprado'
    ];

    public function conteudoCarrinho()
    {
        return $this->hasMany(ConteudoCarrinho::class, 'fk_carrinho');
    }

    public function criarCarrinho(int $idCliente): array
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date = new DateTime();
        $dateString = $date->format('Y-m-d');
        $carrinhoExistente = self::where('fk_cliente', $idCliente)
            ->where('comprado', false)
            ->get()
            ->toArray();

        if (count($carrinhoExistente) == 0) {
            return self::create([
                'fk_cliente' => $idCliente,
                'data' => $dateString
            ])->toArray();
        }
        return [];
    }

    public function atualizarValorCarrinho(int $id, int $idCliente, $valor): bool
    {
        return self::where('id', $id)
            ->where('fk_cliente', $idCliente)
            ->update([
                'valor_total' => $valor
            ]);
    }
}
