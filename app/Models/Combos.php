<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combos extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'valor_promocional_dinheiro',
        'valor_promocional_pix',
        'valor_promocional_cartao',
        'descricao',
        'active'
    ];

    public function conteudoCombos()
    {
        return $this->hasMany(ConteudoCombos::class, 'fk_combo');
    }

    public function criarCombo(object $request): array
    {
        return self::create([
            'titulo' => $request->titulo,
            'valor_promocional_dinheiro' => $request->valor_promocional_dinheiro,
            'valor_promocional_pix' => $request->valor_promocional_pix,
            'valor_promocional_cartao' => $request->valor_promocional_cartao,
            'descricao' => $request->descricao,
        ])->toArray();
    }

    public function lerCombos(): array
    {
        return self::with('conteudoCombos')
            ->with('conteudoCombos.produto')
            ->get()
            ->toArray();
    }

    public function lerCombosPublico(): array
    {
        return self::where('active', true)
            ->with('conteudoCombos')
            ->with('conteudoCombos.produto')
            ->get()
            ->toArray();
    }

    public function lerComboPorId(int $id): array
    {
        return self::where('id', $id)
            ->with('conteudoCombos')
            ->with('conteudoCombos.produto')
            ->get()
            ->toArray();
    }

    public function updateCombo(int $id, object $request): bool
    {
        return self::where('id', $id)
            ->update([
                'titulo' => $request->titulo,
                'valor_promocional_dinheiro' => $request->valor_promocional_dinheiro,
                'valor_promocional_pix' => $request->valor_promocional_pix,
                'valor_promocional_cartao' => $request->valor_promocional_cartao,
                'descricao' => $request->descricao,
            ]);
    }

    public function ativarCombo(int $id): bool
    {
        return self::where('id', $id)
            ->update([
                'active' => true
            ]);
    }

    public function desativarCombo(int $id): bool
    {
        return self::where('id', $id)
            ->update([
                'active' => false
            ]);
    }

    public function updateValueCombo(int $id, array $valores): bool
    {
        return self::where('id', $id)
            ->update([
                'valor_promocional_dinheiro' => $valores['valorDinheiro'],
                'valor_promocional_pix' => $valores['valorPix'],
                'valor_promocional_cartao' => $valores['valorCartao'],
            ]);
    }
}
