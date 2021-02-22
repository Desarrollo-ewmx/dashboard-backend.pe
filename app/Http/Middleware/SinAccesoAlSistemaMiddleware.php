<?php
namespace App\Http\Middleware;
use Closure;
use Session;

class SinAccesoAlSistemaMiddleware {
  public function handle($request, Closure $next) {
    // Verifica si el usuario que intenta acceder tiene o no el permiso de acceder al sistema
    if(auth()->user()->hasRole(config('app.rol_sin_acceso_al_sistema'))) {
      Session::flush(); // Elimina la sesión
      return response()->json(['Acceso al sistema no permitido'],512);
    }
    return $next($request);
  }
}