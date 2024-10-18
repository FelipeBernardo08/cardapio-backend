<?php

namespace App\Http\Controllers;

use App\Models\Combos;
use App\Http\Controllers\AuthController;
use Exception;
use Illuminate\Http\Request;
use PDO;

class CombosController extends Controller
{
    private $combos;
    private $auth;

    public function __construct(Combos $combo, AuthController $authController)
    {
        $this->combos = $combo;
        $this->auth = $authController;
    }

    public function criarCombo(Request $request): object
    {
        try {
            $me = $this->auth->me();
            if ($me[0]['fk_userType'] == 1) {
                $response = $this->combos->criarCombo($request);
                if (count($response) != 0) {
                    return $this->responseOk($response);
                }
                return $this->error('Erro ao criar registro, tente novamte mais tarde!');
            }
            return $this->naoAutorizado();
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function lerCombos(): object
    {
        try {
            $response = $this->combos->lerCombos();
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registros, tente novamte mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function lerCombosPublico(): object
    {
        try {
            $response = $this->combos->lerCombosPublico();
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registros, tente novamte mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function lerComboPorId(int $id): object
    {
        try {
            $response = $this->combos->lerComboPorId($id);
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamte mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function updateCombo(int $id, Request $request): object
    {
        try {
            $me = $this->auth->me();
            if ($me[0]['fk_userType'] == 1) {
                $response = $this->combos->updateCombo($id, $request);
                if ($response) {
                    return $this->responseOk($response);
                }
                return $this->error('Erro ao ler registro, tente novamte mais tarde!');
            }
            return $this->naoAutorizado();
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function ativarCombo(int $id): object
    {
        try {
            $me = $this->auth->me();
            if ($me[0]['fk_userType'] == 1) {
                $response = $this->combos->ativarCombo($id);
                if ($response) {
                    return $this->responseOk($response);
                }
                return $this->error('Erro ao ler registro, tente novamte mais tarde!');
            }
            return $this->naoAutorizado();
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function desativarCombo(int $id): object
    {
        try {
            $me = $this->auth->me();
            if ($me[0]['fk_userType'] == 1) {
                $response = $this->combos->desativarCombo($id);
                if ($response) {
                    return $this->responseOk($response);
                }
                return $this->error('Erro ao ler registro, tente novamte mais tarde!');
            }
            return $this->naoAutorizado();
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function updateValueCombo(int $id): object
    {
        try {
            $responseProductsCombo = $this->combos->lerComboPorId($id);
            $valores = $this->somarValoresCombo($responseProductsCombo[0]['conteudo_combos']);
            $responseCombos = $this->combos->updateValueCombo($id, $valores);
            if ($responseCombos) {
                return response()->json(['msg' => 'Valores atualizados com sucesso!'], 200);
            }
            return $this->error('Erro ao atualizar combos, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function somarValoresCombo(array $conteudos): array
    {
        $valorTotal = 0;
        foreach ($conteudos as $conteudo) {
            $valorTotal += $conteudo['produto']['valor'];
        }
        $valorPix = $valorTotal * (1 - 0.03);
        $valorDinheiro = $valorTotal * (1 - 0.05);
        $valores = [
            'valorCartao' => $valorTotal,
            'valorPix' => $valorPix,
            'valorDinheiro' => $valorDinheiro
        ];
        return $valores;
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
