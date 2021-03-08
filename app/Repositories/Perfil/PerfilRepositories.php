<?php
namespace App\Repositories\Perfil;
//Models
use App\Models\User;
// Repositories
use App\Repositories\Sucursal\SucursalCacheRepositories;

class PerfilRepositories implements PerfilInterface {
  protected $sucursalCacheRepo;
  public function __construct(SucursalCacheRepositories $sucursalCacheRepositories) {
    $this->sucursalCacheRepo    = $sucursalCacheRepositories;
  }
  public function getAutenticado() {
		return auth()->user();
  }
  public function updateDashboard($request) {
    $usuario = User::find(auth()->user()->id);
    $sucursal = null;
    switch($request->campo) {
      case 'sucActiva':
        $usuario->id_suc_act = $request->valor;
        $sucursal = $this->sucursalCacheRepo->getFindOrFailCache($usuario->id_suc_act);
        break;
      case 'lang':
        $usuario->lang = $request->valor;
        break;
      case 'sidebarShow':
        $usuario->sidebarShow = $request->valor;
        break;
      case 'darkMode':
        $usuario->darkMode = $request->valor;
        break;
    }
    $usuario->save();

    return ['usuario' => $usuario, 'sucursal' => $sucursal];
  }
}