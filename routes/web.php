<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


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


// controladores criados com resource, usar o nome da rota no plural e o nome do controller no singular
Route::resource('produtos', ProdutoController::class);

Route::resource('users', UserController::class);

Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::get('/produto/{slug}', [SiteController::class, 'details'])->name('site.details');

Route::get('/categoria/{id}', [SiteController::class, 'categoria'])->name('site.categoria');

Route::get('/carrinho', [CarrinhoController::class, 'carrinhoLista'])->name('site.carrinho');

// Essa rota é referente ao botão comprar, ao clicar, os produtos serão enviados por meio do post p/ rota get carrinho
Route::post('/carrinho', [CarrinhoController::class, 'adicionaCarrinho'])->name('site.addCarrinho');

// Essa rota remove um item do carrinho através do id, que é passado ao clicar no button delete da page carrinho
Route::post('/remover', [CarrinhoController::class, 'removeCarrinho'])->name('site.removeCarrinho');

// Rota para atualizar qnt de itens do carrinho, será tivada ao clicar no refresh
Route::post('/atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('site.atualizaCarrinho');

// Rota responsavel por limpar o carrinho
Route::get('/limpar', [CarrinhoController::class, 'limparCarrinho'])->name('site.limparCarrinho');

// Rota responsavel por retornar a view de login. a rota login irá renderizar o formulario q se encontra em login.form
Route::view('/login', 'login.form' )->name('login.form');

// Rota responsavel por receber os dados do formulario via post]
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/register', [LoginController::class, 'create'])->name('login.create');

//Rota responsavel por exibir o dashboard do admin, que só será mostrado se o user estiver logado.
// o midd. irá redirecionar o user se não estiver logado p/ page login
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'ckeckemail']);





