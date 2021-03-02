<?php
namespace App\Repositories\Permiso;
// Models
use Spatie\Permission\Models\Permission;
// Otros
use Illuminate\Support\Facades\Cache;

class PermisoRepositories implements PermisoInterface {
  public function getAllCache() {
    $permisos = Cache::rememberForever('permisos', function() {
      return Permission::get(['id', 'nom', 'desc']);
    });
    return $permisos;
  }
  public function eliminarCache() {
    Cache::pull('permisos');
  }
}