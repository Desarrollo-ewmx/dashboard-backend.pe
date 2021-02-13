<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// Request
use Illuminate\Http\Request;
// Models
use App\Models\User;
// Repositories
use App\Repositories\Sistema\SistemaRepositories;
use App\Repositories\Sucursal\SucursalRepositories;

class AuthController extends Controller { 
  protected $sistemaRepo;
  protected $sucursalRepo;
  public function __construct(SistemaRepositories $sistemaRepositories, SucursalRepositories $sucursalRepositories) {
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
    $this->sistemaRepo  = $sistemaRepositories;
    $this->sucursalRepo = $sucursalRepositories;
  }
  public function login(Request $request) {
    $credentials = request(['email', 'password']);

    if (! $token = auth()->attempt($credentials)) {
      return abort('403', 'Usuario o contraseña incorrectos.');
    }

    return $this->respondWithToken($token, $request->email);
  }
  public function logout() {
    auth()->logout();
    return response()->json(['message' => 'Successfully logged out']);
  }
  public function refresh() {
    return $this->respondWithToken(auth()->refresh(), auth()->user()->email);
  }
  protected function respondWithToken($token, $email) {
    $usuario  = User::with(['roles:id,name,nom', 'sucursales'])->where('email', '=', $email)->first();

    $resp = $this->data($usuario);
    $resp['access_token'] = $token;
    $resp['token_type'] = 'bearer';
    $resp['expires_in'] = auth()->factory()->getTTL();

    return response()->json($resp);
  }
  protected function getAutenticado() {
    $usuario = auth()->user();
    return response()->json($this->data($usuario));
  }
  protected function data($usuario) {
    $sistema  = $this->sistemaRepo->sistemaFindOrFail();
    $sucursal = $this->sucursalRepo->getCacheFindOrFail($usuario->id_suc_act);
    return [
      'desarrollador' => ['developer'=>config('app.developer'), 'developer_url'=>config('app.developer_url'), 'version_del_sistema'=>config('app.version_del_sistema')],
      'sistema'       => $sistema,
      'usuario'       => $usuario->getattributes(),
      'roless'        => $usuario->roles,
      'permisos'      => $usuario->getPermissionsViaRoles(),
      'sucursal'      => $sucursal,
      'sucursales'    => $usuario->sucursales,
      'roles'         => $usuario->menuroles, // Este se tiene que eliminar ******************
    ];
  }
}