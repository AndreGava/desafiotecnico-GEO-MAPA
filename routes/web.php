<?php

use App\Http\Controllers\MapController;
use App\Livewire\Layers;
use Illuminate\Support\Facades\Route;

Route::get('/', [MapController::class, 'index']);

Route::get('/painel', Layers::class)->middleware('panel.auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
