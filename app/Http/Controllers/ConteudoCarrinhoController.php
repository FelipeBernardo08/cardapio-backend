<?php

namespace App\Http\Controllers;

use App\Models\ConteudoCarrinho;
use App\Models\Produto;
use App\Models\Carrinho;
use App\Http\Controllers\AuthController;
use Exception;
use Illuminate\Http\Request;

class ConteudoCarrinhoController extends Controller
{
    private $conteudo;
    private $produto;
    private $auth;
    private $carrinho;

    public function __construct(
        ConteudoCarrinho $conteudoCarrinho,
        AuthController $authController,
        Produto $produtos,
        Carrinho $carrinhos
    ) {
        $this->conteudo = $conteudoCarrinho;
        $this->auth = $authController;
        $this->produto = $produtos;
        $this->carrinho = $carrinhos;
    }

    public function criarConteudoDoCarrinho(Request $request): object
    {
        try {
            $me = $this->auth->me();
            $idCliente = $me[0]['cliente'][0]['id'];
            $idCarrinho = $me[0]['cliente'][0]['carrinho'][0]['id'];
            $responseProduto = $this->produto->lerProdutoPorIdAtivo($request->fk_produto);
            if (count($responseProduto) != 0) {
                $responseConteudo = $this->conteudo->criarConteudoDoCarrinho($request, $idCliente, $idCarrinho, $responseProduto);
                if (count($responseConteudo) != 0) {
                    $itensCarrinho = $this->conteudo->lerProutosPorIdCarrinho($idCarrinho);
                    $valorProdutosCarrinho = $this->somarValorProdutosCarrinho($itensCarrinho);
                    $this->carrinho->atualizarValorCarrinho($idCarrinho, $idCliente, $valorProdutosCarrinho);
                    return $this->responseOk($responseConteudo);
                }
                return $this->error('Erro ao inserir conteudo no carrinho, tente novamente mais tarde!');
            }
            return $this->erro('Erro, produto inexistente!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function somarValorProdutosCarrinho(array $produtos)
    {
        $valor = 0;
        foreach ($produtos as $produto) {
            $valor += $produto['valor'];
        }
        return $valor;
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
