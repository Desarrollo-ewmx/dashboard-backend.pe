<?php
namespace App\Http\Controllers\Sistema;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\Sistema\SistemaRepositories;

class SistemaController extends Controller {
  protected $sistemaRepo;
  public function __construct(SistemaRepositories $sistemaRepositories) { // Interfaz para implementar solo [metodos]
    $this->sistemaRepo    = $sistemaRepositories;
  }
  public function sistemaFindOrFail() {
		$resp = $this->sistemaRepo->sistemaFindOrFail();
		
    return response()->json(['sistema' => $resp,'desarrollador' => ['developer'=>config('app.developer'), 'developer_url'=>config('app.developer_url'), 'version_del_sistema'=>config('app.version_del_sistema')]], 200);
  }
  public function update(Request $request) {
    $resp = $this->sistemaRepo->update($request);
    return response()->json($resp, 200);
  }
}