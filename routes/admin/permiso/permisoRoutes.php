<?php
use App\Http\Controllers\Permiso\PermisoController;

Route::group(['prefix' => 'permiso'], function() {
  Route::post('', [PermisoController::class, 'index'])->name('permiso.index')->middleware('permission:rol.create|rol.show|rol.edit');
  Route::post('get/{id_permiso}', [PermisoController::class, 'get'])->name('permiso.get')->middleware('permission:rol.show|rol.edit');
  Route::post('actualizar/{id_permiso}', [PermisoController::class, 'update'])->name('permiso.update')->middleware('permission:rol.edit');
  Route::post('getAll', [PermisoController::class, 'getAll'])->name('permiso.getAll')->middleware('permission:rol.create|rol.edit');
});