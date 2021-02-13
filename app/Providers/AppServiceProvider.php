<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Validator;

class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
      //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    Paginator::useBootstrap();
    Schema::defaultStringLength(120); // Longitud maxima de los campos en la base de datos esto es al generar las migraciones
    
    Validator::extend('alpha_telefono', function ($attribute, $value) { // Validación
      return preg_match('/^([0-9\-\(\)\ ]{0,50})?$/', $value); 
    });

    Validator::extend('alpha_unique_where', function ($attribute, $value, $otros) { // Validación
      $tabla  = $otros['0'];
      $inpu   = $otros['1'];
      if(isset($otros['2'])                 ){
          $consul     = 'AND id <>' . $otros['2'];
      } else {
          $consul     = null;
      }
      $resultado = \DB::SELECT("SELECT * FROM $tabla WHERE $attribute = '$value' AND input = '$inpu' $consul");
      if(sizeof($resultado)) {
        return false;
      }
      return true; 
    });
  }
}
