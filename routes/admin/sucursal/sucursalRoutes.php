<?php
use App\Http\Controllers\Sucursal\SucursalController;

Route::group(['prefix' => 'sucursal'], function() {
  Route::post('', [SucursalController::class, 'index'])->name('sucursal.index')->middleware('permission:sucursal.create|sucursal.show|sucursal.edit|sucursal.destroy');
  Route::post('almacenar', [SucursalController::class, 'store'])->name('sucursal.store')->middleware('permission:sucursal.create');
  Route::post('get/{id_sucursal}', [SucursalController::class, 'get'])->name('sucursal.get')->middleware('permission:sucursal.show|sucursal.edit');
  Route::post('actualizar/{id_sucursal}', [SucursalController::class, 'update'])->name('sucursal.update')->middleware('permission:sucursal.edit');
  Route::delete('eliminar/{id_sucursal}', [SucursalController::class, 'destroy'])->name('sucursal.destroy')->middleware('permission:sucursal.destroy');
});