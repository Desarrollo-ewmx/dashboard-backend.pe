<?php
namespace App\Http\Controllers\Rol;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Rol\StoreRolRequest;
use App\Http\Requests\Rol\UpdateRolRequest;
// Repositories
use App\Repositories\Rol\RolRepositories;

class RolController extends Controller {
  protected $rolRepo;
  public function __construct(RolRepositories $rolRepositories) {
    $this->rolRepo = $rolRepositories;
  }
  public function index(Request $request) {
    $sorter       = $request->sorter;
    $tableFilter  = $request->tableFilter;
    $columnFilter = $request->columnFilter;
    $itemsLimit   = $request->itemsLimit;
    $startDate    = $request->startDate;
    $endDate      = $request->endDate;
    $roles        = $this->rolRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

    return response()->json($roles,200);
  } 
  public function store(StoreRolRequest $request) {
    $rol = $this->rolRepo->store($request);
    return response()->json(['id'=>$rol->id],200);
  }
  public function get($id_rol) {
    $rol = $this->rolRepo->getFindOrFail($id_rol, ['permissions:id']);
    return response()->json($rol,200);
  }
  public function update(UpdateRolRequest $request, $id_rol) {
    $rol = $this->rolRepo->update($request, $id_rol);
    return response()->json(['id'=>$rol->id],200);
  }
  public function destroy($id_rol) {
    $this->rolRepo->destroy($id_rol);
    return response()->json(['¡Registro eliminado exitosamente!'],200);
  }
}
