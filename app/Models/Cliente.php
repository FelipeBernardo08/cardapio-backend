<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'fk_user',
        'whatsapp',
        'end_rua',
        'end_numero',
        'end_cidade',
        'end_estado',
        'end_cep',
        'end_lat',
        'end_lon'
    ];

    public function carrinho()
    {
        return $this->hasMany(Carrinho::class, 'fk_cliente');
    }

    public function criarCliente(string $nome, int $idUser): array
    {
        return self::create([
            'nome' => $nome,
            'fk_user' => $idUser
        ])->toArray();
    }

    public function atualizarCadastro(int $id, object $request): bool
    {
        return self::where('id', $id)
            ->update($request->all());
    }
}
