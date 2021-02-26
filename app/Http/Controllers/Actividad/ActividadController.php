<?php
namespace App\Http\Controllers\Actividad;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\Actividad\ActividadRepositories;

class ActividadController extends Controller {
  protected $actividadRepo;
  public function __construct(ActividadRepositories $actividadRepositories) {
    $this->actividadRepo = $actividadRepositories;
  }
  public function index(Request $request) {
    $sorter       = $request->sorter;
    $tableFilter  = $request->tableFilter;
    $columnFilter = $request->columnFilter;
    $itemsLimit   = $request->itemsLimit;
    $id_modelo    = $request->id_modelo;
    $startDate    = $request->startDate;
    $endDate      = $request->endDate;
    $actividades  = $this->actividadRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $id_modelo, $startDate, $endDate);

    return response()->json($actividades,200);
  }
}