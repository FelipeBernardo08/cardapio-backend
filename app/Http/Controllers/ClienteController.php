<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Carrinho;
use App\Models\RecuperacoesDeSenha;
use App\Models\ConfirmacaoContaToken;
use App\Mail\ConfirmarCriacaoConta;
use App\Mail\RecuperarSenha;
use App\Http\Controllers\AuthController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    private $cliente;
    private $user;
    private $carrinho;
    private $recuperacao;
    private $confirmacaoConta;
    private $auth;

    public function __construct(
        Cliente $clientes,
        User $users,
        Carrinho $carrinhos,
        RecuperacoesDeSenha $recuperacaoSenha,
        AuthController $authController,
        ConfirmacaoContaToken $confirm
    ) {
        $this->cliente = $clientes;
        $this->user = $users;
        $this->carrinho = $carrinhos;
        $this->recuperacao = $recuperacaoSenha;
        $this->auth = $authController;
        $this->confirmacaoConta = $confirm;
    }

    public function criarCliente(Request $request): object
    {
        try {
            $responseUser = $this->user->criarCliente($request);
            if (count($responseUser) != 0) {
                $responseCliente = $this->cliente->criarCliente($request->nome, $responseUser['id']);
                if (count($responseCliente) != 0) {
                    $responseConfirmacao = $this->confirmacaoConta->criarConfirmacaoConta($request);
                    if (count($responseConfirmacao) != 0) {
                        $this->carrinho->criarCarrinho($responseCliente['id']);
                        $data = [
                            'token' => $responseConfirmacao['token'],
                            'email' => $responseUser['email'],
                            'id' => $responseUser['id'],
                            //dev
                            'url' => 'http://localhost:8000/api/confirmar-conta'
                            //prod
                            // 'url' => 'https://deliciasdacheiloca.com.br:8081/api/confirmar-conta'
                        ];
                        Mail::to($responseUser['email'])->send(new ConfirmarCriacaoConta($data, 'Confirmar Cadastro'));
                        return response()->json(['msg' => 'Sucesso! Um e-mail foi enviado para o mesmo e-mail de cadastro, necessário confirmar cadastro para utilizar a plataforma'], 200);
                    }
                }
                $this->user->deleteUser($responseUser['id']);
                return $this->error('Erro ao criar cliente.');
            }
            return $this->error('Erro ao criar usuario.');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function ativarCadastro(int $id, string $email, string $token): object
    {
        try {
            $responseTokenConfirm = $this->confirmacaoConta->lerConfirmacaoPorEmail($email);
            if (count($responseTokenConfirm) != 0 && $responseTokenConfirm[0]['token'] == $token) {
                $responseUser = $this->user->ativarUsuario($id, $email);
                if ($responseUser) {
                    return redirect()->route('agradecimento');
                }
                return $this->error('Cadastro não pode ser ativo!');
            }
            return $this->error('Token inválido ou inexistente');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function recuperarSenha(Request $request): object
    {
        try {
            $responseRecuperacao = $this->recuperacao->criarRecuperacao($request);
            if (count($responseRecuperacao) != 0) {
                $data = [
                    'token' => $responseRecuperacao['token_confirmacao']
                ];
                Mail::to($request->email)->send(new RecuperarSenha($data, 'Recuperar Senha'));
                return response()->json(['msg' => 'Sucesso! Foi enviado ao seu e-mail um token para recuperação de senha.'], 200);
            }
            return $this->error('Erro ao solicitar recuperação, tente novamente mais tarde!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function trocarSenhaComToken(Request $request): object
    {
        try {
            $responseTokenConfirmacao = $this->recuperacao->lerConfirmacaoPorEmail($request);
            if ($request->token == $responseTokenConfirmacao[0]['token_confirmacao']) {
                $responseUserChangePassword = $this->user->trocarSenhaRecuperacao($request);
                if ($responseUserChangePassword) {
                    $this->recuperacao->apagarRecuperacaoAposTrocaDeSenha($responseTokenConfirmacao[0]['id']);
                    return response()->json(['msg' => 'Senha atualizada com sucesso!'], 200);
                }
                return $this->error('Erro ao atualizar senha, tente novamente mais tarde!');
            }
            return $this->error('Token inválido');
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
