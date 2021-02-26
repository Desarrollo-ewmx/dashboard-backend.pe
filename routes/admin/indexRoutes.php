<?php
Route::post('autenticado',  'AuthController@getAutenticado')->name('autenticado');
require_once __DIR__ . '/sistema/sistemaRoutes.php';
require_once __DIR__ . '/sucursal/sucursalRoutes.php';
require_once __DIR__ . '/catalogo/catalogoRoutes.php';
require_once __DIR__ . '/actividad/actividadRoutes.php';
require_once __DIR__ . '/imagen/imagenRoutes.php';
require_once __DIR__ . '/rol/rolRoutes.php';

Route::group(['prefix' => 'perfil'], function() {
  require_once __DIR__ . '/perfil/perfilRoutes.php';
});

Route::group(['prefix' => 'usuario'], function() {
  require_once __DIR__ . '/usuario/usuarioRoutes.php';
});

Route::resource('users', 'UsersController')->except( ['create', 'store'] );

/*
  Route::resource('mail',        'MailController');
  Route::get('prepareSend/{id}', 'MailController@prepareSend')->name('prepareSend');
  Route::post('mailSend/{id}',   'MailController@send')->name('mailSend');
  Route::resource('bread',  'BreadController');   //create BREAD (resource)
  Route::get('menu/edit', 'MenuEditController@index');
  Route::get('menu/edit/selected', 'MenuEditController@menuSelected');
  Route::get('menu/edit/selected/switch', 'MenuEditController@switch');
  Route::prefix('menu/menu')->group(function () { 
      Route::get('/',         'MenuEditController@index')->name('menu.menu.index');
      Route::get('/create',   'MenuEditController@create')->name('menu.menu.create');
      Route::post('/store',   'MenuEditController@store')->name('menu.menu.store');
      Route::get('/edit',     'MenuEditController@edit')->name('menu.menu.edit');
      Route::post('/update',  'MenuEditController@update')->name('menu.menu.update');
      Route::get('/delete',   'MenuEditController@delete')->name('menu.menu.delete');
  });
  Route::prefix('menu/element')->group(function () { 
      Route::get('/',             'MenuElementController@index')->name('menu.index');
      Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
      Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
      Route::get('/create',       'MenuElementController@create')->name('menu.create');
      Route::post('/store',       'MenuElementController@store')->name('menu.store');
      Route::get('/get-parents',  'MenuElementController@getParents');
      Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
      Route::post('/update',      'MenuElementController@update')->name('menu.update');
      Route::get('/show',         'MenuElementController@show')->name('menu.show');
      Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
  });
  Route::prefix('media')->group(function ($router) {
      Route::get('/',                 'MediaController@index')->name('media.folder.index');
      Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
      Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
      Route::get('/folder',           'MediaController@folder')->name('media.folder');
      Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
      Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

      Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
      Route::get('/file',             'MediaController@file');
      Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
      Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
      Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
      Route::post('/file/cropp',      'MediaController@cropp');
      Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');

      Route::get('/file/download',    'MediaController@fileDownload');
  });
*/