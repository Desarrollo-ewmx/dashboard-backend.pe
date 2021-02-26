<?php
namespace App\Repositories\PapeleraDeReciclaje\Tabla\Sucursal;

interface SucursalPapeleraInterface {
  public function metodo($metodo, $consulta);

  public function metDestroy($consulta);
}