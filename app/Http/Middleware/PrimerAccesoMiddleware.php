<?php
namespace App\Http\Middleware;
use Closure;

class PrimerAccesoMiddleware {
	public function handle($request, Closure $next) {
		// Registra la fecha de primer acceso al sistema
		if(auth()->user()->email_verified_at == null) {
			$usuario = \App\Models\User::findOrFail(auth()->user()->id);
			$usuario->email_verified_at = now();
			$usuario->save();
		}
		return $next($request); 
	}
}