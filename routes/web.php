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

Route::prefix('painel')->group(base_path('routes/painel.php'));

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

Route::get('/procurar', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

Route::get('/like', [App\Http\Controllers\CommentController::class, 'like'])->middleware('auth');
Route::get('/dislike', [App\Http\Controllers\CommentController::class, 'dislike'])->middleware('auth');

Route::post('post/comentar/', [App\Http\Controllers\CommentController::class, 'store'])->middleware('auth')->name('commentPost');

Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('postView');

Route::get('/categorias/{id}', [App\Http\Controllers\PostController::class, 'category'])->name('postCategory');

Auth::routes();

Route::get('painel/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('usuario/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('userView');

Route::get('excluir-comentario/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->middleware('auth')->name('commentDestroy');

Route::get('excluir-post/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->middleware('auth')->name('postDestroy');

Route::get('interesse/quero-ir', [App\Http\Controllers\InterestController::class, 'queroIr'])->middleware('auth')->name('reactionQueroIr');

Route::get('interesse/ja-fui', [App\Http\Controllers\InterestController::class, 'jaFui'])->middleware('auth')->name('reactionJaFui');

Route::get('interesse/nao-iria-novamente', [App\Http\Controllers\InterestController::class, 'naoIriaNovamente'])->middleware('auth')->name('reactionNaoIriaNovamente');


