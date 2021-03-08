<?php
namespace App\Repositories\Sucursal;
// Models
use App\Models\Sucursal;
// Otros
use Illuminate\Support\Facades\Cache;

class SucursalCacheRepositories implements SucursalCacheInterface {
  public function getFindOrFailCache($id_sucursal) {
    $sucursal = Cache::rememberForever('sucursal-'.$id_sucursal, function() use($id_sucursal){
      return Sucursal::with(['etiquetas'])->findOrFail($id_sucursal);
    });
    return $sucursal;
  }
  public function eliminarCache($id_sucursal) {
    Cache::pull('sucursal-'.$id_sucursal);
  }
  public function checkSucursalActiva() {
    $suc_act = $this->getFindOrFailCache(auth()->user()->id_suc_act);
    
    if($suc_act->id == 1) {
      return abort(403, 'Debe seleccionar una sucursal.');
    }
    return $suc_act;
  }
}