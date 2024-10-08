<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesas extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'valor',
        'data_dia',
        'data_mes',
        'data_ano'
    ];

    public function lerDespesas(): array
    {
        return self::get()->toArray();
    }

    public function lerDespesaId(int $id): array
    {
        return self::where('id', $id)->get()->toArray();
    }

    public function criarDespes(object $request): array
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date = new DateTime();
        $request->data_dia =  $date->format('d');
        $request->data_mes =  $date->format('m');
        $request->data_ano =  $date->format('Y');
        return self::create($request->all())->toArray();
    }

    public function atualizarDespesas(int $id, object $request): bool
    {
        return self::where('id', $id)
            ->update($request->all());
    }
}
