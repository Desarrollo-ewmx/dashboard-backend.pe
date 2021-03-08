<?php
namespace App\Repositories\Sucursal;

interface SucursalCacheInterface {  
  public function getFindOrFailCache($request);

  public function eliminarCache($id_sucursal);
}