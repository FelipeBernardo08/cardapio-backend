<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private $categoria;

    public function __construct(Categoria $categorias)
    {
        $this->categoria = $categorias;
    }

    public function criarCategoria(Request $request): object
    {
        try {
            $response = $this->categoria->criarCategoria($request);
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao criar registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function lerCategoria(): object
    {
        try {
            $response = $this->categoria->lerCategoria();
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function lerCategoriaPublico(): object
    {
        try {
            $response = $this->categoria->lerCategoriaPublico();
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function lerCategoriaPorId(int $id): object
    {
        try {
            $response = $this->categoria->lerCategoriaPorId($id);
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function atualizarCategoria(int $id, Request $request): object
    {
        try {
            $response = $this->categoria->atualizarCategoria($id, $request);
            if ($response) {
                return response()->json(['msg' => 'Registro atualizado com sucesso!'], 200);
            }
            return $this->error('Erro ao ler registro, tente novamente mais tarde!');
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
