<?php
namespace App\Http\Controllers\Catalogo;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\Catalogo\StoreCatalogoRequest;
// Repositories
use App\Repositories\Catalogo\CatalogoRepositories;

class CatalogoController extends Controller {
  protected $catalogoRepo;
  public function __construct(CatalogoRepositories $catalogoRepositories) {
    $this->catalogoRepo = $catalogoRepositories;
  }
  public function index(Request $request) {
    $sorter         = $request->input('sorter');
    $tableFilter    = $request->input('tableFilter');
    $columnFilter   = $request->input('columnFilter');
    $itemsLimit     = $request->input('itemsLimit');
    $catalogos = $this->catalogoRepo->index($sorter, $tableFilter, $columnFilter, $itemsLimit);

    return response()->json($catalogos,200);
  }
  public function store(StoreCatalogoRequest $request) {
    $catalogo = $this->catalogoRepo->store($request);
    return response()->json(['id'=>$catalogo->id], 200);
  }
  public function getAllCache(Request $request) {
    $catalogos = $this->catalogoRepo->getAllCache($request->input);
    return response()->json($catalogos, 200);
  }
}