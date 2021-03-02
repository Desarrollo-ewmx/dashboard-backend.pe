<?php
namespace App\Repositories\Rol;
// Models
use Spatie\Permission\Models\Role;
// Events
use App\Events\layouts\ActividadesRegistradas;
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\PapeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\DB;

class RolRepositories implements RolInterface {
  protected $papeleraRepo;
  public function __construct(PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->papeleraRepo = $papeleraDeReciclajeRepositories;
  } 
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate) {
    $db = DB::table('roles')
    ->whereNull('deleted_at')
    ->where('name', '!=', config('app.rol_desarrollador'))
    ->where('name', '!=', config('app.rol_sin_acceso_al_sistema'))
    ->where('name', '!=', config('app.rol_cliente'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->select('id', 'nom', 'desc', 'created_at');

    if(isset($columnFilter['id'])) {
      $db->where('id', 'like', '%'.$columnFilter['id'].'%');
    }
    if(isset($columnFilter['nom'])) {
      $db->where('nom', 'like', '%'.$columnFilter['nom'].'%');
    }
    if(isset($columnFilter['desc'])) {
      $db->where('desc', 'like', '%'.$columnFilter['desc'].'%');
    }
    if(isset($columnFilter['created_at'])) {
      $db->where('created_at', 'like', '%'.$columnFilter['created_at'].'%');
    }
     
    if(strlen($tableFilter) > 0) {
      $db->where(function ($query) use ($tableFilter) {
        $query->where('id', 'like', '%'.$tableFilter.'%')
            ->orWhere('nom', 'like', '%'.$tableFilter.'%')
            ->orWhere('desc', 'like', '%'.$tableFilter.'%')
            ->orWhere('created_at', 'like', '%'.$tableFilter.'%');
      });
    }

    if(!empty($sorter)){
      if($sorter['asc'] === false){
        $sortCase = 'desc';
      }else{
        $sortCase = 'asc';
      }
      switch($sorter['column']){
        case 'id':
          $db->orderBy('id', $sortCase);
        break;
        case 'nom':
          $db->orderBy('nom', $sortCase);
        break;
        case 'desc':
          $db->orderBy('desc', $sortCase);
        break;
        case 'created_at':
          $db->orderBy('created_at', $sortCase);
        break;
        default:
          $db->orderBy('id', 'desc');
          break;
      }
    }
      
    return $db->paginate($itemsLimit);
  }
  public function store($request) {
    $rol                  = new Role();
    $rol->nom             = $request->nom;
    $rol->name            = $request->slug;
    $rol->desc            = $request->desc;
    $rol->asig_reg        = auth()->user()->email_registro;
    $rol->created_at_reg  = auth()->user()->email_registro;
    $rol->save();
    $rol->givePermissionTo($request->permis);

    return $rol;
  }
  public function update($request, $id_rol) {
      /*
    $sucursal           = $this->getFindOrFailCache($id_sucursal);
    $sucursal->suc      = $request->suc;
    $sucursal->direc    = $request->direc;
    $sucursal->s  = $request->s;
   
    if($sucursal->isDirty()) {
      $info = (object) [
        'modulo'=>'Sucursales', 'modelo'=>'App\Models\Sucursal', 'ruta'=>'Detalles Sucursal', 'permisos'=>'sucursal.show,sucursal.edit', 'request'=>$sucursal,
        'campos'  => [
                        ['suc', 'Sucursal'],
                        ['direc', 'Dirección'],
                        ['s', 'Serie']
                      ]];
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadesRegistradas::dispatch($info); 
      $sucursal->updated_at_reg  = auth()->user()->email_registro;
    }
    $sucursal->save();
    $this->eliminarCache($id_sucursal);

    return $sucursal;
    */
  }
  public function destroy($id_rol) {
      /*
    $sucursal = $this->getFindOrFail($id_sucursal, ['usuarios:id,name,apell,email_registro']);

    $suc_usu = count($sucursal->usuarios);
    if($suc_usu > 0) {
      return abort(403, '¡Esta sucursal esta vinculado a '.$suc_usu.' usuarios por lo cual no se puede eliminar!');
    }

    $sucursal->delete();

    $this->eliminarCache($id_sucursal);

    $info = (object) ['modulo'=>'Sucursales', 'modelo'=>'App\Models\Sucursal', 'ruta'=>'Detalles Sucursal', 'permisos'=>'sucursal.show,sucursal.edit','id'=>$sucursal->id,'campo'=>'Registro BD', 'valores'=>['Registro en existencia', 'Registro enviado a la papelera de reciclaje']];
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ActividadRegistrada::dispatch($info);
    
    $info = (object) [
      'modulo'    => 'Sucursales', // Nombre del módulo del sistema
      'modelo'    => 'App\Models\Sucursal',
      'registro'  => $sucursal->suc, // Información a mostrar en la papelera
      'tabla'     => 'sucursales', // Nombre de la tabla en la BD
      'id_reg'    => $sucursal->id, // ID de registro eliminado
      'id_fk'     => null, // ID de la llave foranea con la que tiene relación 
     ];
    $this->papeleraRepo->store($info);

    return $sucursal;
    */
  }
  public function getFindOrFail($id_rol, $relaciones) {
    return Role::with($relaciones)->findOrFail($id_rol);
  }
}