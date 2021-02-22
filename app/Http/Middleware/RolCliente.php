<?php
namespace App\Http\Middleware;
use Closure;

class RolCliente {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		// VERIFICA SI EL USUARIO AUTENTICADO TIENE EL ROL DE ADMINISTRADOR
    $es_cliente = false;
    $roles = auth()->user()->menuroles;
    $array_roles = explode(',', $roles);

    foreach($array_roles as $rol) {
      if($rol == 'cliente') {
        $es_cliente = true;
      }
    }

		if(!$es_cliente){
			return response()->json(['message' => 'No autenticado. Se requiere rol de cliente'], 401);
		}
		return $next($request);
	}
}
