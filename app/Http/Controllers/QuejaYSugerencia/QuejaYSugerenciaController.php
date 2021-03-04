<?php
namespace App\Http\Controllers\QuejaYSugerencia;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\QuejaYSugerencia\StoreQuejaYSugerenciaRequest;
// Repositories
use App\Repositories\QuejaYSugerencia\QuejaYSugerenciaRepositories;

class QuejaYSugerenciaController extends Controller {
  protected $quejaYSugerenciaRepo;
  public function __construct(QuejaYSugerenciaRepositories $quejaYSugerenciaRepositories) {
    $this->quejaYSugerenciaRepo = $quejaYSugerenciaRepositories;
  }
  public function index(Request $request) {
    $sorter       = $request->sorter;
    $tableFilter  = $request->tableFilter;
    $columnFilter = $request->columnFilter;
    $itemsLimit   = $request->itemsLimit;
    $startDate    = $request->startDate;
    $endDate      = $request->endDate;
    $quejas_y_sugerencias   = $this->quejaYSugerenciaRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

    return response()->json($quejas_y_sugerencias,200);
  }
  public function store(StoreQuejaYSugerenciaRequest $request) {
    $queja_y_sugerencia = $this->quejaYSugerenciaRepo->store($request);
    return response()->json(['id'=>$queja_y_sugerencia->id],200);
  }
  public function get($id_queya_y_sugerencia) {
    $queya_y_sugerencia = $this->quejaYSugerenciaRepo->getFindOrFail($id_queya_y_sugerencia, []);
    return response()->json($queya_y_sugerencia,200);
  }
}