<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
        'end_rua',
        'end_numero',
        'end_estado',
        'end_cidade'
    ];

    public function lerClientes(): array
    {
        return self::get()->toArray();
    }

    public function lerClienteId(int $id): array
    {
        return self::where('id', $id)->get()->toArray();
    }

    public function criarCliente(object $request): array
    {
        return self::create($request->all())->toArray();
    }

    public function atualizarCliente(int $id, object $request): bool
    {
        return self::where('id', $id)->update($request->all());
    }
}
