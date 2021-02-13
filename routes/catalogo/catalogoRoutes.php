<?php
use App\Http\Controllers\Catalogo\CatalogoController;

Route::post('almacenar',  [CatalogoController::class, 'store'])->name('catalogo.store')->middleware('permission:catalogo.store');
Route::post('getAll', [CatalogoController::class, 'getAllCache'])->name('catalogo.getAllCache')->middleware('permission:sucursal.create|sucursal.edit');
