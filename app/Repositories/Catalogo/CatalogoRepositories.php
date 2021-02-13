<?php
namespace App\Repositories\Catalogo;
//Models
use App\Models\Catalogo;
// Otros
use Illuminate\Support\Facades\Cache;

class CatalogoRepositories implements CatalogoInterface {
  public function getAutenticado() {
		return auth()->user();
  }
  public function store($request) {
    $catalogo = new Catalogo();
    $catalogo->input          = $request->input;
    $catalogo->value          = $request->valor;
    $catalogo->text           = $request->valor;
    $catalogo->asig_reg       = auth()->user()->email_registro;
    $catalogo->created_at_reg = auth()->user()->email_registro;
    $catalogo->save();

    return $catalogo;
  }
  public function getAllCache($input) {
    $sucursal = Cache::rememberForever('catalogos-'.$input, function() use($input){
      return Catalogo::where('input', $input)->orderBy('value', 'asc')->get();
    });
    return $sucursal;
  }
}