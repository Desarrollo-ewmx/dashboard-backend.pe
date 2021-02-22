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
    $sorter       = $request->input('sorter');
    $tableFilter  = $request->input('tableFilter');
    $columnFilter = $request->input('columnFilter');
    $itemsLimit   = $request->input('itemsLimit');
    $id_modelo    = $request->input('id_modelo');
    $actividades = $this->actividadRepo->getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $id_modelo);

    return response()->json($actividades,200);
  }
}