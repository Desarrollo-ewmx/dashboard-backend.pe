<?php
namespace App\Http\Controllers\Sucursal;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Sucursal\StoreSucursalRequest;
// Repositories
use App\Repositories\Sucursal\SucursalRepositories;

class SucursalController extends Controller {
  protected $sucursalRepo;
  public function __construct(SucursalRepositories $sucursalRepositories) {
    $this->sucursalRepo    = $sucursalRepositories;
  }
  public function index(Request $request) {
    $sorter         = $request->input('sorter');
    $tableFilter    = $request->input('tableFilter');
    $columnFilter   = $request->input('columnFilter');
    $itemsLimit     = $request->input('itemsLimit');
    $sucursales = $this->sucursalRepo->index($sorter, $tableFilter, $columnFilter, $itemsLimit);

    return response()->json($sucursales,200);
  }
  public function store(StoreSucursalRequest $request) {
    $sucursal = $this->sucursalRepo->store($request);
    return response()->json([$sucursal->id],200);
  }
}