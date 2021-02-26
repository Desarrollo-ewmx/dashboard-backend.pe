<?php
use App\Http\Controllers\Imagen\ImagenController;

Route::group(['prefix' => 'imagen', 'middleware' => ['permission:sucursal.edit']], function() {
  Route::post('one/almacenar/{opcion}/{id}',  [ImagenController::class, 'storeOne'])->name('imagen.createOne');
  Route::post('many/almacenar/{opcion}/{id}',  [ImagenController::class, 'storeMany'])->name('imagen.createMany');
  Route::delete('eliminar/{opcion}/{id}',  [ImagenController::class, 'destroy'])->name('imagen.destroy');
});