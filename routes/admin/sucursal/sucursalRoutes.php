<?php
use App\Http\Controllers\Sucursal\SucursalController;

Route::group(['prefix' => 'sucursal'], function() {
  Route::post('', [SucursalController::class, 'index'])->name('sucursal.index')->middleware('permission:sucursal.create|sucursal.show|sucursal.edit|sucursal.destroy');
  Route::post('almacenar',  [SucursalController::class, 'store'])->name('sucursal.create')->middleware('permission:sucursal.create');
  Route::get('detalles/{id_sucursal}',  [SucursalController::class, 'show'])->name('sucursal.show')->middleware('permission:sucursal.show');
  Route::put('actualizar/{id_sucursal}',  [SucursalController::class, 'update'])->name('sucursal.edit')->middleware('permission:sucursal.edit');
  Route::delete('eliminar/{id_sucursal}',  [SucursalController::class, 'destroy'])->name('sucursal.destroy');
});