<?php
use App\Http\Controllers\Sucursal\SucursalController;
Route::post('', [SucursalController::class, 'index'])->name('sucursal.index')->middleware('permission:sucursal.create|sucursal.show|sucursal.edit|sucursal.destroy');
Route::post('almacenar',  [SucursalController::class, 'store'])->name('sucursal.create')->middleware('permission:sucursal.create');