<?php
namespace App\Http\Controllers\Sucursal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Sucursal\StoreSucursalRequest;
use App\Http\Requests\Sucursal\UpdateSucursalRequest;
// Repositories
use App\Repositories\Sucursal\SucursalRepositories;
use App\Repositories\Actividad\ActividadRepositories;

class SucursalController extends Controller {
  protected $sucursalRepo;
  protected $actividadRepo;
  public function __construct(SucursalRepositories $sucursalRepositories, ActividadRepositories $actividadRepositories) {
    $this->sucursalRepo    = $sucursalRepositories;
    $this->actividadRepo    = $actividadRepositories;
  }
  public function index(Request $request) {
    $sorter         = $request->input('sorter');
    $tableFilter    = $request->input('tableFilter');
    $columnFilter   = $request->input('columnFilter');
    $itemsLimit     = $request->input('itemsLimit');
    $sucursales = $this->sucursalRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit);

    return response()->json($sucursales,200);
  }
  public function store(StoreSucursalRequest $request) {
    $sucursal = $this->sucursalRepo->store($request);
    return response()->json(['id'=>$sucursal->id],200);
  }
  public function show($id_sucursal) {
    $sucursal = $this->sucursalRepo->getFindOrFailCache($id_sucursal);
    return response()->json($sucursal,200);
  }
  public function update(UpdateSucursalRequest $request, $id_sucursal) {
    $sucursal = $this->sucursalRepo->update($request, $id_sucursal);
    return response()->json($sucursal,200);
  //  return response()->json(['id'=>$sucursal->id],200);
  }
  public function destroy($id_sucursal) {
    $this->sucursalRepo->destroy($id_sucursal);
    return response()->json(['¡Registro eliminado exitosamente!'],200);
  }
}