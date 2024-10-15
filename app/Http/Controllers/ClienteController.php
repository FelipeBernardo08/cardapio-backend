<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private $cliente;
    private $user;

    public function __construct(Cliente $clientes, User $users)
    {
        $this->cliente = $clientes;
        $this->user = $users;
    }

    public function criarCliente(Request $request): object
    {
        try {
            $responseUser = $this->user->criarCliente($request);
            if (count($responseUser) != 0) {
                $responseCliente = $this->cliente->criarCliente($request->nome, $responseUser['id']);
                if (count($responseCliente) != 0) {
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
