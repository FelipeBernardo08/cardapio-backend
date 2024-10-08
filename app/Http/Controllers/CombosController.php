<?php

namespace App\Http\Controllers;

use App\Models\Combos;
use Exception;
use Illuminate\Http\Request;
use PDO;

class CombosController extends Controller
{
    private $combos;

    public function __construct(Combos $combo)
    {
        $this->combos = $combo;
    }

    public function criarCombo(Request $request): object
    {
        try {
            $response = $this->combos->criarCombo($request);
            if (count($response) != 0) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao criar registro, tente novamte mais tarde!');
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
            $response = $this->combos->updateCombo($id, $request);
            if ($response) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamte mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function ativarCombo(int $id): object
    {
        try {
            $response = $this->combos->ativarCombo($id);
            if ($response) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamte mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function desativarCombo(int $id): object
    {
        try {
            $response = $this->combos->desativarCombo($id);
            if ($response) {
                return $this->responseOk($response);
            }
            return $this->error('Erro ao ler registro, tente novamte mais tarde!');
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
