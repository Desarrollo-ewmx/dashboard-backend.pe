<?php
namespace App\Repositories\Sucursal;
// Models
use App\Models\Sucursal;
// Events
use App\Events\layouts\ActividadRegistrada;
// Repositories
//use App\Repositories\PapeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Cache;

class SucursalRepositories implements SucursalInterface {
//  protected $papeleraDeReciclajeRepo;
//  public function __construct(PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
//    $this->papeleraDeReciclajeRepo    = $papeleraDeReciclajeRepositories;
//  } 
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit) {
    $db = Sucursal::where('id', '!=', 1)->select('id', 'suc', 'ser_cot');

    if( isset($columnFilter['id']) ){
      $db->where('id', 'like', '%' . $columnFilter['id'] . '%');
    }
    if( isset($columnFilter['suc']) ){
      $db->where('suc', 'like', '%' . $columnFilter['suc'] . '%');
    }
    if( isset($columnFilter['ser_cot']) ){
      $db->where('ser_cot', 'like', '%' . $columnFilter['ser_cot'] . '%');
    }
     
    if( strlen($tableFilter) > 0 ){
      $db->where(function ($query) use ($tableFilter) {
        $query->where('id', 'like', '%'.$tableFilter.'%')
            ->orWhere('suc', 'like', '%'.$tableFilter.'%')
            ->orWhere('ser_cot', 'like', '%'.$tableFilter.'%');
      });
    }

    if( !empty($sorter) ){
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
    $sucursal->ser_cot        = $request->ser_cot;
    $sucursal->created_at_reg = auth()->user()->email_registro;
    $sucursal->save();

    return $sucursal;
  }
  public function update($request, $id_sucursal) {
    $sucursal           = $this->getFindOrFailCache($id_sucursal);
    $sucursal->suc      = $request->suc;
    $sucursal->direc    = $request->direc;
    $sucursal->ser_cot  = $request->ser_cot;
   
    if($sucursal->isDirty()) {
      $info = (object) [
        'modulo'=>'Sucursales', 'modelo'=>'App\Models\Sucursal', 'ruta'=>'/sucursales/detalles/', 'permisos'=>'sucursal.show,sucursal.edit', 'request'=>$sucursal,
        'campos'  => [
                        ['suc', 'Sucursal'],
                        ['direc', 'Dirección'],
                        ['ser_cot', 'Serie']
                      ]];
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadRegistrada::dispatch($info); 
      $sucursal->updated_at_reg  = auth()->user()->email_registro;
    }
    $sucursal->save();
    $this->eliminarCache($id_sucursal);

    return $sucursal;
  }
  public function destroy($id_sucursal) {
    $sucursal = $this->getFindOrFailCache($id_sucursal);
    $sucursal->delete();
/*
    $this->papeleraDeReciclajeRepo->store([
      'modulo'      => 'Sucursales', // Nombre del módulo del sistema
      'registro'    => $sucursal->nom, // Información a mostrar en la papelera
      'tab'         => 'sucursales', // Nombre de la tabla en la BD
      'id_reg'      => $sucursal->id, // ID de registro eliminado
      'id_fk'       => null // ID de la llave foranea con la que tiene relación           
    ]);
*/
    return $sucursal;
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