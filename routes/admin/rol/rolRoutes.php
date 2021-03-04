<?php
use App\Http\Controllers\Rol\RolController;

Route::group(['prefix' => 'rol'], function() {
  Route::post('', [RolController::class, 'index'])->name('rol.index')->middleware('permission:rol.create|rol.show|rol.edit|rol.destroy');
  Route::post('almacenar', [RolController::class, 'store'])->name('rol.store')->middleware('permission:rol.create');
  Route::post('get/{id_rol}', [RolController::class, 'get'])->name('rol.get')->middleware('permission:rol.show|rol.edit');
  Route::post('actualizar/{id_rol}', [RolController::class, 'update'])->name('rol.update')->middleware('permission:rol.edit');
  Route::delete('eliminar/{id_rol}', [RolController::class, 'destroy'])->name('rol.destroy')->middleware('permission:rol.destroy');
});
