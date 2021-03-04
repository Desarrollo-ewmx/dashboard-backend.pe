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

    if(!empty($sorter)) {
      if($sorter['asc'] === false){
        $sortCase = 'desc';
      }else{
        $sortCase = 'asc';
      }
      switch($sorter['column']) {
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
    $rol->name            = $request->name;
    $rol->desc            = $request->desc;
    $rol->created_at_reg  = auth()->user()->email_registro;
    $rol->save();
    $rol->givePermissionTo($request->permis);

    return $rol;
  }
  public function update($request, $id_rol) {
    $rol        = $this->getFindOrFail($id_rol, []);
    $rol->nom   = $request->nom;
    $rol->desc  = $request->desc;
   
    if($rol->isDirty()) {
      $info = (object) [
        'modulo'=>'Roles', 'modelo'=>'Spatie\Permission\Models\Role', 'ruta'=>'Detalles Rol', 'permisos'=>'rol.show,rol.edit', 'request'=>$rol,
        'campos'  => [
                        ['nom', 'Rol'],
                        ['desc', 'Descripción']
                      ]];
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadesRegistradas::dispatch($info); 
      $rol->updated_at_reg  = auth()->user()->email_registro;
    }
    $rol->save();
    $rol->permissions()->sync($request->permis);

    return $rol;
  }
  public function destroy($id_rol) {
    $rol = $this->getFindOrFail($id_rol, ['users:id,name,apell,email_registro']);

    $rol_usu = count($rol->users);
    if($rol_usu > 0) {
      return abort(403, '¡Este rol esta vinculado a '.$rol_usu.' usuarios por lo cual no se puede eliminar!');
    }

    $rol->delete();

    $info = (object) ['modulo'=>'Roles', 'modelo'=>'Spatie\Permission\Models\Role', 'ruta'=>'Detalles Rol', 'permisos'=>'rol.show,rol.edit','id'=>$rol->id,'campo'=>'Registro BD', 'valores'=>['Registro en existencia', 'Registro enviado a la papelera de reciclaje']];
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ActividadRegistrada::dispatch($info);
    
    $info = (object) [
      'modulo'    => 'Roles', // Nombre del módulo del sistema
      'modelo'    => 'Spatie\Permission\Models\Role',
      'registro'  => $rol->nom, // Información a mostrar en la papelera
      'tabla'     => 'roles', // Nombre de la tabla en la BD
      'id_reg'    => $rol->id, // ID de registro eliminado
      'id_fk'     => null, // ID de la llave foranea con la que tiene relación 
     ];
    $this->papeleraRepo->store($info);

    return $rol;
  }
  public function getFindOrFail($id_rol, $relaciones) {
    return Role::with($relaciones)
        ->select(['id', 'nom', 'name', 'desc', 'created_at_reg', 'updated_at_reg', 'created_at', 'updated_at'])
        ->where('name', '!=', config('app.rol_desarrollador'))
        ->where('name', '!=', config('app.rol_sin_acceso_al_sistema'))
        ->where('name', '!=', config('app.rol_cliente'))
        ->findOrFail($id_rol);
  }
}