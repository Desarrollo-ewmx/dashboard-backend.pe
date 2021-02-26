<?php
use App\Http\Controllers\Actividad\ActividadController;

Route::group(['prefix' => 'actividad'], function() {
  Route::post('', [ActividadController::class, 'index'])->name('actividad.index')->middleware('permission:actividad.show|actividad.fullShow');
});