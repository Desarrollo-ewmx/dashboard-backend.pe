<?php
namespace App\Http\Controllers\Permiso;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Permiso\UpdatePermisoRequest;
// Repositories
use App\Repositories\Permiso\PermisoRepositories;

class PermisoController extends Controller {
  protected $permisoRepo;
  public function __construct(PermisoRepositories $permisoRepositories) {
    $this->permisoRepo = $permisoRepositories;
  }
  public function index(Request $request) {
    $sorter       = $request->sorter;
    $tableFilter  = $request->tableFilter;
    $columnFilter = $request->columnFilter;
    $itemsLimit   = $request->itemsLimit;
    $startDate    = $request->startDate;
    $endDate      = $request->endDate;
    $permisos     = $this->permisoRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

    return response()->json($permisos,200);
  }
  public function get($id_permiso) {
    $permiso = $this->permisoRepo->getFindOrFail($id_permiso, []);
    return response()->json($permiso,200);
  }
  public function update(UpdatePermisoRequest $request, $id_permiso) {
    $permiso = $this->permisoRepo->update($request, $id_permiso);
    return response()->json(['id'=>$permiso->id],200);
  }
  public function getAll() {
    $permisos = $this->permisoRepo->getAllCache();

    return response()->json($permisos,200);
  }
}
