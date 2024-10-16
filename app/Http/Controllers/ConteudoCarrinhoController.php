<?php

namespace App\Http\Controllers;

use App\Models\ConteudoCarrinho;
use App\Http\Controllers\AuthController;
use Exception;
use Illuminate\Http\Request;

class ConteudoCarrinhoController extends Controller
{
    private $conteudo;
    private $auth;

    public function __construct(ConteudoCarrinho $conteudoCarrinho, AuthController $authController)
    {
        $this->conteudo = $conteudoCarrinho;
        $this->auth = $authController;
    }

    public function criarConteudoDoCarrinho(Request $request): object
    {
        try {
            $me = $this->auth->me();
            $responseConteudo = $this->conteudo->criarConteudoDoCarrinho($request, $me[0]['cliente'][0]['id'], $me[0]['cliente'][0]['carrinho'][0]['id']);
            //atualizar valor do carrinho
            if (count($responseConteudo) != 0) {
                return $this->responseOk($responseConteudo);
            }
            return $this->error('Erro ao inserir conteudo no carrinho, tente novamente mais tarde!');
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
