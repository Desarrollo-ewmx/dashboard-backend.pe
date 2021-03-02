<?php
namespace App\Http\Controllers\Permiso;
use App\Http\Controllers\Controller;
// Repositories
use App\Repositories\Permiso\PermisoRepositories;

class PermisoController extends Controller {
  protected $permisoRepo;
  public function __construct(PermisoRepositories $permisoRepositories) {
    $this->permisoRepo = $permisoRepositories;
  }
  public function getAll() {
    $permisos = $this->permisoRepo->getAllCache();

    return response()->json($permisos,200);
  }
}
