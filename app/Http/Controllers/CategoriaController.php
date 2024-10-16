<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Controllers\AuthController;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private $categoria;
    private $auth;

    public function __construct(Categoria $categorias, AuthController $authController)
    {
        $this->categoria = $categorias;
        $this->auth = $authController;
    }

    public function criarCategoria(Request $request): object
    {
        try {
            $me = $this->auth->me();
            if ($me[0]['fk_userType'] == 1) {
                $response = $this->categoria->criarCategoria($request);
                if (count($response) != 0) {
                    return $this->responseOk($response);
                }
                return $this->error('Erro ao criar registro, tente novamente mais tarde!');
            }
            return $this->naoAutorizado();
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
            $me = $this->auth->me();
            if ($me[0]['fk_userType'] == 1) {
                $response = $this->categoria->atualizarCategoria($id, $request);
                if ($response) {
                    return response()->json(['msg' => 'Registro atualizado com sucesso!'], 200);
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
