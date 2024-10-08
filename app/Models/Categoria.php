<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo'
    ];

    public function produto()
    {
        return $this->hasMany(Produto::class, 'fk_categoria');
    }

    public function criarCategoria(object $request): array
    {
        return self::create([
            'titulo' => $request->titulo
        ])->toArray();
    }

    public function lerCategoria(): array
    {
        return self::with('produto')->get()->toArray();
    }

    public function lerCategoriaPublico(): array
    {
        return self::with(['produto' => function ($query) {
            $query->where('active', true);
        }])->get()->toArray();
    }


    public function lerCategoriaPorId(int $id): array
    {
        return self::where('id', $id)->with('produto')->get()->toArray();
    }

    public function atualizarCategoria(int $id, object $request): bool
    {
        return self::where('id', $id)
            ->update([
                'titulo' => $request->titulo
            ]);
    }
}
