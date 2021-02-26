<?php
namespace App\Http\Middleware;
use Closure;

class Autenticado {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    // Verifica si el usuario aun esta logueado
    if(empty(auth()->user())) {
      return response()->json(['response'=>['status'=> 401,'data'=>['message'=>'Su sesión a terminado']],'message' => 'Su sesión a terminado'], 401);
    }
    return $next($request);
  }
}
