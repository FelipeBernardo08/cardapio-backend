<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct(Produto $produtos)
    {
        $this->produto = $produtos;
    }

    public function criarProduto(Request $request): object
    {
        try {
            $response = $this->produto->criarProduto($request);
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao criar registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function lerProdutos(): object
    {
        try {
            $response = $this->produto->lerProdutos();
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registros, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function lerProdutoPorId(int $id): object
    {
        try {
            $response = $this->produto->lerProdutoPorId($id);
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function atualizarProduto(int $id, Request $request): object
    {
        try {
            $response = $this->produto->atualizarProduto($id, $request);
            if ($response) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao atualizar registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function desativarProduto(int $id): object
    {
        try {
            $response = $this->produto->desativarProduto($id);
            if ($response) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao atualizar registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function ativarProduto(int $id): object
    {
        try {
            $response = $this->produto->ativarProduto($id);
            if ($response) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao atualizar registro, tente novamente mais tarde!');
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
