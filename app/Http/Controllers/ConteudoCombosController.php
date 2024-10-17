<?php

namespace App\Http\Controllers;

use App\Models\ConteudoCombos;
use App\Http\Controllers\AuthController;
use Exception;
use Illuminate\Http\Request;

class ConteudoCombosController extends Controller
{
    private $conteudosCombos;
    private $auth;

    public function __construct(ConteudoCombos $conteudo, AuthController $authController)
    {
        $this->conteudosCombos = $conteudo;
        $this->auth = $authController;
    }

    public function criarConteudoCombo(Request $request): object
    {
        try {
            $me = $this->auth->me();
            if ($me[0]['fk_userType'] == 1) {
                $response = $this->conteudosCombos->criarConteudoCombo($request);
                if (count($response) != 0) {
                    return $this->responseOk($response);
                }
                return $this->error('Erro ao ler registro, tente novamente mais tarde!');
            }
            return $this->naoAutorizado();
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function apagarConteudoCombo(int $id): object
    {
        try {
            $me = $this->auth->me();
            if ($me[0]['fk_userType'] == 1) {
                $response = $this->conteudosCombos->apagarConteudoCombo($id);
                if ($response) {
                    return response()->json(['msg' => 'Registro apagado com sucesso!'], 200);
                }
                return $this->error('Erro ao ler registro, tente novamente mais tarde!');
            }
            return $this->naoAutorizado();
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

    public function naoAutorizado(): object
    {
        return response()->json(['error' => 'Não autorizado!'], 403);
    }
}
