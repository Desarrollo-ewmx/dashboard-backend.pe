<?php
use App\Http\Controllers\Actividad\ActividadController;

Route::group(['prefix' => 'actividad'], function() {
  Route::post('', [ActividadController::class, 'index'])->name('sucursal.index')->middleware('permission:sucursal.show|sucursal.edit');
});