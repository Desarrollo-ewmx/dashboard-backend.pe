<?php
namespace App\Http\Middleware;
use Closure;

class RolAdmin {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		// VERIFICA SI EL USUARIO AUTENTICADO TIENE EL ROL DE ADMINISTRADOR
    $es_admin = false;
    $roles = auth()->user()->menuroles;
    $array_roles = explode(',', $roles);

    foreach($array_roles as $rol) {
      if($rol == 'admin') {
        $es_admin = true;
      }
    }

		if(!$es_admin){
			return response()->json(['message' => 'No autenticado. Se requiere rol de administrador'], 401);
		}
		return $next($request);
	}
}
