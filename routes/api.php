<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CombosController;
use App\Http\Controllers\ConteudoCarrinhoController;
use App\Http\Controllers\ConteudoCombosController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('jwt.auth')->group(function () {
    //login
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    //categoria
    Route::post('criar-categoria', [CategoriaController::class, 'criarCategoria']);
    Route::get('ler-categorias', [CategoriaController::class, 'lerCategoria']);
    Route::get('ler-categoria/{id}', [CategoriaController::class, 'lerCategoriaPorId']);
    Route::put('atualizar-categoria/{id}', [CategoriaController::class, 'atualizarCategoria']);

    //produtos
    Route::post('criar-produto', [ProdutoController::class, 'criarProduto']);
    Route::get('ler-produtos', [ProdutoController::class, 'lerProdutos']);
    Route::get('ler-produto/{id}', [ProdutoController::class, 'lerProdutoPorId']);
    Route::put('atualizar-produto/{id}', [ProdutoController::class, 'atualizarProduto']);
    Route::put('ativar-produto/{id}', [ProdutoController::class, 'ativarProduto']);
    Route::put('desativar-produto/{id}', [ProdutoController::class, 'desativarProduto']);

    //combos
    Route::post('criar-combo', [CombosController::class, 'criarCombo']);
    Route::get('ler-combos', [CombosController::class, 'lerCombos']);
    Route::put('atualizar-combo/{id}', [CombosController::class, 'updateCombo']);
    Route::put('ativar-combo/{id}', [CombosController::class, 'ativarCombo']);
    Route::put('desativar-combo/{id}', [CombosController::class, 'desativarCombo']);
    Route::put('atualizar-valor-combo/{id}', [CombosController::class, 'updateValueCombo']);


    //conteudoCombo
    Route::post('criar-conteudo-combo', [ConteudoCombosController::class, 'criarConteudoCombo']);
    Route::delete('apagar-conteudo-combo/{id}', [ConteudoCombosController::class, 'apagarConteudoCombo']);

    //compras
    Route::post('inserir-produto-carrinho', [ConteudoCarrinhoController::class, 'criarConteudoDoCarrinho']);
    Route::delete('apagar-produto-carrinho/{id}', [ConteudoCarrinhoController::class, 'removerConteudoCarrinho']);
});

//login
Route::post('login', [AuthController::class, 'login']);

//categoria
Route::get('ler-categorias-publico', [CategoriaController::class, 'lerCategoriaPublico']);

//combo
Route::get('ler-combos-publico', [CombosController::class, 'lerCombosPublico']);
Route::get('ler-combo/{id}', [CombosController::class, 'lerComboPorId']);

//cliente
Route::post('criar-cliente', [ClienteController::class, 'criarCliente']);
Route::get('confirmar-conta/{id}/{email}/{token}', [ClienteController::class, 'ativarCadastro']);
Route::post('recuperar-senha', [ClienteController::class, 'recuperarSenha']);
