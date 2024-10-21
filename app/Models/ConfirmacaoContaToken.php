<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmacaoContaToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token'
    ];

    public function criarConfirmacaoConta(object $request): array
    {
        return self::create([
            'email' => $request->email,
            'token' => $this->gerarToken()
        ])->toArray();
    }

    public function lerConfirmacaoPorEmail(string $email): array
    {
        return self::where('email', $email)
            ->get()
            ->toArray();
    }

    private function gerarToken(): string
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
