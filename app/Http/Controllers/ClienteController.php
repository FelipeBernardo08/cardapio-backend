<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Carrinho;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private $cliente;
    private $user;
    private $carrinho;

    public function __construct(Cliente $clientes, User $users, Carrinho $carrinhos)
    {
        $this->cliente = $clientes;
        $this->user = $users;
        $this->carrinho = $carrinhos;
    }

    public function criarCliente(Request $request): object
    {
        try {
            $responseUser = $this->user->criarCliente($request);
            if (count($responseUser) != 0) {
                $responseCliente = $this->cliente->criarCliente($request->nome, $responseUser['id']);
                if (count($responseCliente) != 0) {
                    $this->carrinho->criarCarrinho($responseCliente['id']);
                    return response()->json(['msg' => 'Sucesso!'], 200);
                }
                $this->user->deleteUser($responseUser['id']);
                return $this->error('Erro ao criar cliente.');
            }
            return $this->error('Erro ao criar usuario.');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function responseOk($response): object
    {
        return response()->json($response, 200);
    }

    public function error(string $message): object
    {
        return response()->json(['error' => $message], 404);
    }
}
