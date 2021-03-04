<?php
namespace App\Repositories\PapeleraDeReciclaje\Tabla\Sucursal;
// Events
use App\Events\layouts\ArchivosEliminados;

class SucursalPapeleraRepositories implements SucursalPapeleraInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ArchivosEliminados::dispatch([$consulta->log_nom]);
  }
}