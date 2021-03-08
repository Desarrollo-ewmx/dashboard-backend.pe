<?php
Route::group(['middleware' => 'api'], function ($router) {

  Route::get('pruebas', function () {
    return 'Hello World';
  });

  require_once __DIR__ . '/public/indexRoutes.php';

  Route::group(['middleware' => ['autenticado', 'sinAccesoAlSistema', 'idiomaSistema', 'primerAcceso']], function ($router) {
    Route::group(['middleware' => ['rolCliente'], 'prefix' => 'rc'], function ($router) {
      require_once __DIR__ . '/client/indexRoutes.php';
    });

    Route::group(['middleware' => ['rolAdmin'], 'prefix' => 'admin'], function ($router) {
      require_once __DIR__ . '/admin/indexRoutes.php';
    });
  });
});
