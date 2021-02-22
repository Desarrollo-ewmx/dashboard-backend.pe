<?php
namespace App\Http\Middleware;
use Closure;

class IdiomaSistemaMiddleware {
  public function handle($request, Closure $next) {
    // Definir el idioma del sistema dependiendo la configuración que tenga el usuario en su perfil
    \App::setLocale(auth()->user()->lang); 
    return $next($request);  
  }
}