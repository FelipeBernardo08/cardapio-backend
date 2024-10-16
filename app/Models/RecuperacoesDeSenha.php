<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecuperacoesDeSenha extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token_confirmacao',
    ];

    public function criarRecuperacao(object $request): array
    {
        return self::create([
            'email' => $request->email,
            'token_confirmacao' => $this->gerarToken(),
        ])->toArray();
    }

    public function lerConfirmacaoPorEmail(object $request): array
    {
        return self::where('email', $request->email)
            ->get()
            ->toArray();
    }

    public function apagarRecuperacaoAposTrocaDeSenha(int $id): bool
    {
        return self::where('id', $id)
            ->delete();
    }

    private function gerarToken()
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{};:,.<>?';
        $token = '';
        $caracteresLength = strlen($caracteres);
        for ($i = 0; $i < 8; $i++) {
            $token .= $caracteres[rand(0, $caracteresLength - 1)];
        }
        return $token;
    }
}
