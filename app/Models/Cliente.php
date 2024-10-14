<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'whatsapp',
        'cpf',
        'end_rua',
        'end_numero',
        'end_cidade',
        'end_estado',
        'end_cep',
        'fk_user'
    ];
}
