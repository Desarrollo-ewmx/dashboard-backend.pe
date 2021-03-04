<?php
use App\Http\Controllers\QuejaYSugerencia\QuejaYSugerenciaController;

Route::group(['prefix' => 'queja-y-sugerencia'], function() {
  Route::post('', [QuejaYSugerenciaController::class, 'index'])->name('quejaYSugerencia.index')->middleware('permission:quejaYSugerencia.create|quejaYSugerencia.show|quejaYSugerencia.edit|quejaYSugerencia.destroy');
  Route::post('almacenar', [QuejaYSugerenciaController::class, 'store'])->name('quejaYSugerencia.store')->middleware('permission:quejaYSugerencia.create');
  Route::post('get/{id_queja_y_sugerencia}', [QuejaYSugerenciaController::class, 'get'])->name('quejaYSugerencia.get')->middleware('permission:quejaYSugerencia.show|quejaYSugerencia.edit');
});