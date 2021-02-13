<?php
namespace App\Http\Controllers\Perfil;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Repositories
use App\Repositories\Perfil\PerfilRepositories;

class PerfilController extends Controller {
  protected $perfilRepo;
  public function __construct(PerfilRepositories $perfilRepositories) {
    $this->perfilRepo = $perfilRepositories;
  }
  public function updateDashboard(Request $request) {
    $resp = $this->perfilRepo->updateDashboard($request);
    return response()->json($resp, 200);
  }
}