<?php
Route::post('login', 'AuthController@login')->name('login');
Route::post('logout', 'AuthController@logout')->name('logout');
Route::post('refresh', 'AuthController@refresh')->name('refresh');
Route::post('sistema/default', 'Sistema\SistemaController@sistemaFindOrFail');

  //  Route::post('lazyTable', 'LazyTableController@index');
  //  Route::get('langlist', 'LocaleController@getLangList');
  //  Route::get('menu', 'MenuController@index');
  //  Route::post('register', 'AuthController@register')->name('register');
  //  Route::resource('notes', 'NotesController');
  //  Route::resource('resource/{table}/resource', 'ResourceController');
