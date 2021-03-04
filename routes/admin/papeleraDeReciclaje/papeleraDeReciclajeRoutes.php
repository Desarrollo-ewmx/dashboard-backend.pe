<?php
use App\Http\Controllers\PapeleraDeReciclaje\PapeleraController;

Route::group(['prefix' => 'papelera'], function() {
  Route::post('', [PapeleraController::class, 'index'])->name('sucursal.index')->middleware('permission:sucursal.show|sucursal.restore|sucursal.destroy');
  Route::post('restaurar/{id_sucursal}', [PapeleraController::class, 'restore'])->name('sucursal.restore')->middleware('permission:sucursal.restore');
  Route::delete('eliminar/{id_sucursal}', [PapeleraController::class, 'destroy'])->name('sucursal.destroy')->middleware('permission:sucursal.destroy');
});