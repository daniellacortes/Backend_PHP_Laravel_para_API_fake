<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('pessoa', PessoaController::class) ->middleware('auth:sanctum');
