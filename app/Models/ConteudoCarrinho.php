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

    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'fk_produto');
    }

    public function criarConteudoDoCarrinho(object $request, int $idCLiente, int $idCarrinho, array $produto): array
    {
        $valorFinal = $request->quantidade * $produto[0]['valor'];
        return self::create([
            'fk_produto' => $request->fk_produto,
            'fk_cliente' => $idCLiente,
            'fk_carrinho' => $idCarrinho,
            'quantidade' => $request->quantidade,
            'valor' => $valorFinal
        ])->toArray();
    }

    public function removerConteudoCarrinho(int $id, int $idCliente, int $idCarrinho): bool
    {
        return self::where('id', $id)
            ->where('fk_carrinho', $idCarrinho)
            ->where('fk_cliente', $idCliente)
            ->delete();
    }

    public function lerProutosPorIdCarrinho(int $id): array
    {
        return self::where('fk_carrinho', $id)
            ->get()
            ->toArray();
    }
}
