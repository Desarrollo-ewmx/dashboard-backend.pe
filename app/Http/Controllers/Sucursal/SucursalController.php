<?php
namespace App\Http\Controllers\Sucursal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Sucursal\StoreSucursalRequest;
use App\Http\Requests\Sucursal\UpdateSucursalRequest;
// Repositories
use App\Repositories\Sucursal\SucursalRepositories;
use App\Repositories\Sucursal\SucursalCacheRepositories;

class SucursalController extends Controller {
  protected $sucursalRepo;
  protected $sucursalCacheRepo;
  public function __construct(SucursalRepositories $sucursalRepositories, SucursalCacheRepositories $sucursalCacheRepositories) {
    $this->sucursalRepo       = $sucursalRepositories;
    $this->sucursalCacheRepo  = $sucursalCacheRepositories;
  }
  public function index(Request $request) {
    $sorter       = $request->sorter;
    $tableFilter  = $request->tableFilter;
    $columnFilter = $request->columnFilter;
    $itemsLimit   = $request->itemsLimit;
    $startDate    = $request->startDate;
    $endDate      = $request->endDate;
    $sucursales   = $this->sucursalRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

    return response()->json($sucursales,200);
  }
  public function store(StoreSucursalRequest $request) {
    $sucursal = $this->sucursalRepo->store($request);
    return response()->json(['id'=>$sucursal->id],200);
  }
  public function get($id_sucursal) {
    $sucursal = $this->sucursalCacheRepo->getFindOrFailCache($id_sucursal);
    return response()->json($sucursal,200);
  }
  public function update(UpdateSucursalRequest $request, $id_sucursal) {
    $sucursal = $this->sucursalRepo->update($request, $id_sucursal);
    return response()->json(['id'=>$sucursal->id],200);
  }
  public function destroy($id_sucursal) {
    $this->sucursalRepo->destroy($id_sucursal);
    return response()->json(['¡Registro eliminado exitosamente!'],200);
  }
}