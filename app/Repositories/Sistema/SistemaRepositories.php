<?php
namespace App\Repositories\Sistema;
// Models
use App\Models\Sistema;
// Otros
use Illuminate\Support\Facades\Cache;

class SistemaRepositories implements SistemaInterface {
  public function sistemaFindOrFail() {
    $datos = Cache::rememberForever('sistema', function() {
      return Sistema::findOrFail(1);
    });
    return $datos;
  }
  public function update($request) {
    return $request->all();
  }
}