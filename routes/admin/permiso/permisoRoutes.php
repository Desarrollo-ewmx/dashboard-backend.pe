<?php
use App\Http\Controllers\Permiso\PermisoController;

Route::group(['prefix' => 'permiso'], function() {
  Route::post('getAll', [PermisoController::class, 'getAll'])->name('permiso.getAll')->middleware('permission:rol.create|rol.edit');
});