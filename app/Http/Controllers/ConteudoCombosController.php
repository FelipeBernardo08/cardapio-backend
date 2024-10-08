<?php

namespace App\Http\Controllers;

use App\Models\ConteudoCombos;
use Exception;
use Illuminate\Http\Request;

class ConteudoCombosController extends Controller
{
    private $conteudosCombos;

    public function __construct(ConteudoCombos $conteudo)
    {
        $this->conteudosCombos = $conteudo;
    }

    public function criarConteudoCombo(Request $request): object
    {
        try {
            $response = $this->conteudosCombos->criarConteudoCombo($request);
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function apagarConteudoCombo(int $id): object
    {
        try {
            $response = $this->conteudosCombos->apagarConteudoCombo($id);
            if ($response) {
                return response()->json(['msg' => 'Registro apagado com sucesso!'], 200);
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
