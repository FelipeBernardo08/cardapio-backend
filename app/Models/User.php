<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'fk_userType',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function adm()
    {
        return $this->hasMany(Administrador::class, 'fk_user');
    }

    public function cliente()
    {
        return $this->hasMany(Cliente::class, 'fk_user');
    }

    public function criarCliente(object $request): array
    {
        return self::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ])->toArray();
    }

    public function deleteUser(int $id): bool
    {
        return self::where('id', $id)
            ->delete();
    }

    public function lerUsuarioPorEmail(array $credenciais): array
    {
        return self::where('email', $credenciais['email'])
            ->get()
            ->toArray();
    }

    public function ativarUsuario(int $id, string $email): bool
    {
        return self::where('id', $id)
            ->where('email', $email)
            ->update([
                'active' => true
            ]);
    }

    public function trocarSenhaRecuperacao(object $request): bool
    {
        return self::where('email', $request->email)
            ->update([
                'password' => bcrypt($request->password)
            ]);
    }

    public function getUserAdm(int $idUser): array
    {
        return self::where('id', $idUser)
            ->with('adm')
            ->get()
            ->toArray();
    }

    public function getUserCliente(int $idUser): array
    {
        return self::where('id', $idUser)
            ->with('cliente')
            ->with('cliente.carrinho')
            ->with('cliente.carrinho.conteudoCarrinho')
            ->with('cliente.carrinho.conteudoCarrinho.produtos')
            ->get()
            ->toArray();
    }
}
