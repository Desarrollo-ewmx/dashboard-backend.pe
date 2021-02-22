<?php
Route::group(['prefix' => 'web'], function() {
  require_once __DIR__ . '/paginaWeb/paginaWebRoutes.php';
});

require_once __DIR__ . '/auth/authRoutes.php';
