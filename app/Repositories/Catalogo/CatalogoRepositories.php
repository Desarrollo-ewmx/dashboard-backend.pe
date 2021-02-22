<?php
namespace App\Repositories\Catalogo;
//Models
use App\Models\Catalogo;
// Otros
use Illuminate\Support\Facades\Cache;

class CatalogoRepositories implements CatalogoInterface {
  public function index($request) {
  }
  public function store($request) {
    $catalogo = new Catalogo();
    $catalogo->input          = $request->input;
    $catalogo->value          = $request->valor;
    $catalogo->text           = $request->valor;
    $catalogo->asig_reg       = auth()->user()->email_registro;
    $catalogo->created_at_reg = auth()->user()->email_registro;
    $catalogo->save();

    $this->eliminarCache($catalogo->input);
    return $catalogo;
  }
  public function getAllCache($input) {
    $sucursal = Cache::rememberForever('catalogos-'.$input, function() use($input){
      return Catalogo::where('input', $input)->orderBy('value', 'asc')->get();
    });
    return $sucursal;
  }
  public function eliminarCache($input) {
    Cache::pull('catalogos-'.$input);
  }
}