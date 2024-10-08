<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'valor',
        'fk_categoria',
        'active'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'fk_categoria');
    }

    public function criarProduto(object $request): array
    {
        return self::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'fk_categoria' => $request->fk_categoria
        ])->toArray();
    }

    public function lerProdutos(): array
    {
        return self::with('categoria')
            ->get()
            ->toArray();
    }

    public function lerProdutoPorId(int $id): array
    {
        return self::where('id', $id)
            ->with('categoria')
            ->get()
            ->toArray();
    }

    public function atualizarProduto(int $id, object $request): bool
    {
        return self::where('id', $id)
            ->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'valor' => $request->valor
            ]);
    }

    public function desativarProduto(int $id): bool
    {
        return self::where('id', $id)
            ->update([
                'active' => false
            ]);
    }


    public function ativarProduto(int $id): bool
    {
        return self::where('id', $id)
            ->update([
                'active' => true
            ]);
    }
}
