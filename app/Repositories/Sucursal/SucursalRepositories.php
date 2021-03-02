<?php
namespace App\Repositories\Sucursal;
// Models
use App\Models\Sucursal;
// Events
use App\Events\layouts\ActividadesRegistradas;
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\PapeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SucursalRepositories implements SucursalInterface {
  protected $papeleraRepo;
  public function __construct(PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->papeleraRepo = $papeleraDeReciclajeRepositories;
  } 
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate) {
    $db = DB::table('sucursales')
    ->whereNull('deleted_at')
    ->where('id', '!=', 1)
    ->whereBetween('created_at', [$startDate, $endDate])
    ->select('id', 'suc', 'ser_cot', 'created_at');

    if(isset($columnFilter['id'])) {
      $db->where('id', 'like', '%'.$columnFilter['id'].'%');
    }
    if(isset($columnFilter['suc'])) {
      $db->where('suc', 'like', '%'.$columnFilter['suc'].'%');
    }
    if(isset($columnFilter['ser_cot'])) {
      $db->where('ser_cot', 'like', '%'.$columnFilter['ser_cot'].'%');
    }
    if(isset($columnFilter['created_at'])) {
      $db->where('created_at', 'like', '%'.$columnFilter['created_at'].'%');
    }
     
    if(strlen($tableFilter) > 0) {
      $db->where(function ($query) use ($tableFilter) {
        $query->where('id', 'like', '%'.$tableFilter.'%')
            ->orWhere('suc', 'like', '%'.$tableFilter.'%')
            ->orWhere('ser_cot', 'like', '%'.$tableFilter.'%')
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
        case 'suc':
          $db->orderBy('suc', $sortCase);
        break;
        case 'ser_cot':
          $db->orderBy('ser_cot', $sortCase);
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
    $sucursal                 = new Sucursal();
    $sucursal->suc            = $request->suc;
    $sucursal->direc          = $request->direc;
    $sucursal->ser_cot        = $request->ser_cotiz;
    $sucursal->created_at_reg = auth()->user()->email_registro;
    $sucursal->save();

    return $sucursal;
  }
  public function update($request, $id_sucursal) {
    $sucursal           = $this->getFindOrFailCache($id_sucursal);
    $sucursal->suc      = $request->suc;
    $sucursal->direc    = $request->direc;
    $sucursal->ser_cot  = $request->ser_cotiz;
   
    if($sucursal->isDirty()) {
      $info = (object) [
        'modulo'=>'Sucursales', 'modelo'=>'App\Models\Sucursal', 'ruta'=>'Detalles Sucursal', 'permisos'=>'sucursal.show,sucursal.edit', 'request'=>$sucursal,
        'campos'  => [
                        ['suc', 'Sucursal'],
                        ['direc', 'Dirección'],
                        ['ser_cot', 'Serie']
                      ]];
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadesRegistradas::dispatch($info); 
      $sucursal->updated_at_reg  = auth()->user()->email_registro;
    }
    $sucursal->save();
    $this->eliminarCache($id_sucursal);

    return $sucursal;
  }
  public function destroy($id_sucursal) {
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
  }
  public function getFindOrFail($id_sucursal, $relaciones) {
    return Sucursal::with($relaciones)->findOrFail($id_sucursal);
  }
  public function getFindOrFailCache($id_sucursal) {
    $sucursal = Cache::rememberForever('sucursal-'.$id_sucursal, function() use($id_sucursal){
      return Sucursal::with(['etiquetas'])->findOrFail($id_sucursal);
    });
    return $sucursal;
  }
  public function eliminarCache($id_sucursal) {
    Cache::pull('sucursal-'.$id_sucursal);
  }
}