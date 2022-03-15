<?php

use Illuminate\Support\Facades\Route;




Route::name('painel.')->middleware('auth')->group(function(){
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::get('/criar-post', [App\Http\Controllers\PostController::class, 'create'])->name('postCreate');
	Route::post('/armazenar-post', [App\Http\Controllers\PostController::class, 'store'])->name('postStore');


	Route::get('/quero-ir', [App\Http\Controllers\InterestController::class, 'viewQueroIr'])->name('queroIr');
	Route::get('/ja-fui', [App\Http\Controllers\InterestController::class, 'viewJaFui'])->name('jaFui');
	Route::get('/nao-voltaria', [App\Http\Controllers\InterestController::class, 'viewNaoVoltaria'])->name('naoVoltaria');

	Route::get('/excluir-interesse/{id}', [App\Http\Controllers\InterestController::class, 'interestDestroy'])->name('interestDestroy');
});