<?php
use App\Http\Controllers\Catalogo\CatalogoController;

Route::group(['prefix' => 'catalogo'], function() {
  Route::post('almacenar',  [CatalogoController::class, 'store'])->name('catalogo.create')->middleware('permission:catalogo.create');
  Route::post('getAll', [CatalogoController::class, 'getAllCache'])->name('catalogo.getAllCache')->middleware('permission:sucursal.create|sucursal.edit');
});
