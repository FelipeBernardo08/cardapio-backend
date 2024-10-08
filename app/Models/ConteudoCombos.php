<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConteudoCombos extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_produto',
        'fk_combo',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'fk_produto');
    }

    public function combo()
    {
        return $this->belongsTo(Combos::class, 'fk_combo');
    }

    public function criarConteudoCombo(object $request): array
    {
        return self::create([
            'fk_produto' => $request->fk_produto,
            'fk_combo' => $request->fk_combo,
        ])->toArray();
    }

    public function apagarConteudoCombo(int $id): bool
    {
        return self::where('id', $id)
            ->delete();
    }
}
