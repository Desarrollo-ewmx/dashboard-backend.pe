<?php
namespace App\Http\Controllers\PapeleraDeReciclaje;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\PapeleraDeReciclaje\PapeleraDeReciclajeRepositories;

class PapeleraController extends Controller {
  protected $papeleraRepo;
  public function __construct(PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->papeleraRepo = $papeleraDeReciclajeRepositories;
  }
  public function index(Request $request) {
    $sorter       = $request->sorter;
    $tableFilter  = $request->tableFilter;
    $columnFilter = $request->columnFilter;
    $itemsLimit   = $request->itemsLimit;
    $startDate    = $request->startDate;
    $endDate      = $request->endDate;
    $registros   = $this->papeleraRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate);

    return response()->json($registros,200);
  }
  public function restore($id_registro) {
    $this->papeleraRepo->restore($id_registro);
    return response()->json(['¡Registro restaurado exitosamente!'],200);
  }
  public function destroy($id_registro) {
    $this->papeleraRepo->destroy($id_registro);
    return response()->json(['¡Registro eliminado exitosamente!'],200);
  }
}