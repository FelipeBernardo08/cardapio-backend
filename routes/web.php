<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/confirmar-conta', function () {
    return view('ConfirmarEmail');
});

Route::get('/agradecimento', function () {
    return view('Agradecimento');
})->name('agradecimento');
