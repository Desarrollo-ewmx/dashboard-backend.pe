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
    
    Validator::extend('alpha_solo_espacios_letras_punto', function ($attribute, $value) { // Validación
      return preg_match('/^[\pL\s\.]+$/u', $value); 
    });
    Validator::extend('alpha_solo_puntos_y_letras', function ($attribute, $value) { // Validación
      return preg_match('/^([a-z\.]{0,61})?$/', $value); 
    });
    Validator::extend('alpha_solo_numeros', function ($attribute, $value) { // Validación
      return preg_match('/^([0-9]{0,50})?$/', $value); 
    });
    Validator::extend('alpha_solo_numeros_guiones', function ($attribute, $value) { // Validación
      return preg_match('/^([0-9\-]{0,50})?$/', $value); 
    });
    Validator::extend('alpha_decimal15', function ($attribute, $value) { // Validación
      return preg_match('/^([0-9\.]{0,15})?$/', $value); 
    });
    Validator::extend('alpha_decimal18', function ($attribute, $value) { // Validación
      return preg_match('/^([0-9\.]{0,18})?$/', $value); 
    });
    Validator::extend('alpha_decimal7', function ($attribute, $value) { // Validación
      return preg_match('/^([0-9\.]{0,7})?$/', $value); 
    });
    Validator::extend('alpha_unique_where', function ($attribute, $value, $otros) { // Validación
      // Ejemplo alpha_unique_where:nombre_de_la_tabla_bd,nombre_del_campo_agrupado,nombre_del_campo_a_validar
      // Ejemplo alpha_unique_where:catalogos,Cotizaciones (Serie),value
      $tabla  = $otros['0'];
      $inpu   = $otros['1'];

      if(isset($otros['2'])) {
        $attribute = $otros['2'];
      }
      if(isset($otros['3'])) {
        $consul     = 'AND id <>' . $otros['3'];
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
