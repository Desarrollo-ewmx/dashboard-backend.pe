<?php
namespace App\Repositories\PapeleraDeReciclaje;
// Models
use App\Models\PapeleraDeReciclaje;
// Repositories
use App\Repositories\papeleraDeReciclaje\tabla\Sucursal\SucursalPapeleraRepositories;
//Otro
use DB;

class PapeleraDeReciclajeRepositories implements PapeleraDeReciclajeInterface {
  protected $sucursalRepo;
  public function __construct(SucursalPapeleraRepositories $sucursalRepositories) {
    $this->sucursalRepo = $sucursalRepositories;
  }
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate) {
    $db = DB::table('papelera_de_reciclaje as papelera')
    ->whereBetween('papelera.created_at', [$startDate, $endDate])
    ->join('users', 'users.id', '=', 'papelera.user_id')
    ->select('papelera.*', 'users.name', 'users.email_registro');

    if(isset($columnFilter['id'])) {
      $db->where('papelera.id', 'like', '%'.$columnFilter['id'].'%');
    }
    if(isset($columnFilter['mod'])) {
      $db->where('papelera.mod', 'like', '%'.$columnFilter['mod'].'%');
    }
    if(isset($columnFilter['papelera_id'])) {
      $db->where('papelera.papelera_id', 'like', '%'.$columnFilter['papelera_id'].'%');
      $db->orWhere('papelera.reg', 'like', '%'.$columnFilter['papelera_id'].'%');
    }
    if(isset($columnFilter['id_fk'])) {
      $db->where('papelera.id_fk', 'like', '%'.$columnFilter['id_fk'].'%');
    }
    if(isset($columnFilter['email_registro'])) {
      $db->where('users.email_registro', 'like', '%'.$columnFilter['email_registro'].'%');
      $db->orWhere('users.name', 'like', '%'.$columnFilter['email_registro'].'%');
    }
    if(isset($columnFilter['created_at'])) {
      $db->where('papelera.created_at', 'like', '%'.$columnFilter['created_at'].'%');
    }

    if(strlen($tableFilter) > 0 ) {
      $db->where(function ($query) use ($tableFilter) {
        $query->where('papelera.id', 'like', '%'.$tableFilter.'%')
            ->orWhere('papelera.mod', 'like', '%'.$tableFilter.'%')
            ->orWhere('papelera.papelera_id', 'like', '%'.$tableFilter.'%')
            ->orWhere('papelera.reg', 'like', '%'.$tableFilter.'%')
            ->orWhere('papelera.id_fk', 'like', '%'.$tableFilter.'%')
            ->orWhere('users.email_registro', 'like', '%'.$tableFilter.'%')
            ->orWhere('users.name', 'like', '%'.$tableFilter.'%')
            ->orWhere('papelera.created_at', 'like', '%'.$tableFilter.'%');
      });
    }

    if(!empty($sorter) ) {
      if($sorter['asc'] === false){
        $sortCase = 'desc';
      }else{
        $sortCase = 'asc';
      }
      switch($sorter['column']) {
        case 'id':
          $db->orderBy('papelera.id', $sortCase);
        break;
        case 'mod':
          $db->orderBy('papelera.mod', $sortCase);
        break;
        case 'papelera_id':
          $db->orderBy('papelera.reg', $sortCase);
        break;
        case 'id_fk':
          $db->orderBy('papelera.id_fk', $sortCase);
        break;
        case 'email_registro':
          $db->orderBy('users.name', $sortCase);
        break;
        case 'created_at':
          $db->orderBy('papelera.created_at', $sortCase);
        break;
        default:
          $db->orderBy('papelera.id', 'desc');
          break;
      }
    }
    return $db->paginate($itemsLimit);
  }
  public function getFindOrFail($id_registro) {
    $registro = PapeleraDeReciclaje::findOrFail($id_registro);
    return $registro;
  }
  public function store($info) {
    $papelera = new PapeleraDeReciclaje();
    $papelera->user_id        = auth()->user()->id;
    $papelera->papelera_id    = $info->id_reg;
    $papelera->papelera_type  = $info->modelo;
    $papelera->mod            = $info->modulo;
    $papelera->reg            = $info->registro;
    $papelera->tab            = $info->tabla;
    $papelera->id_fk          = $info->id_fk;
    $papelera->save();
    return $papelera;
  }
  public function restore($id_registro) {
    $registro   = $this->getFindOrFail($id_registro);
    $resultado  = $this->tablas($registro, 'restore');
    if($resultado->existe_llave_primaria == false) { return abort(403, '¡No puedes restaurar este registro!'); }
    $resultado->consulta->restore();
    $this->destroyAllPapeleraByIdFk($registro->id, $resultado->consulta->id);

    return $registro;
  }
  public function destroy($id_registro) {
    $registro   = $this->getFindOrFail($id_registro);
    $resultado  = $this->tablas($registro, 'destroy');
    $resultado->consulta->forceDelete();
    $this->destroyAllPapeleraByIdFk($registro->id, $resultado->consulta->id);

    return $registro;
  }
  public function destroyAllPapeleraByIdFk($id_registro, $id_consulta) {
    $registros =  PapeleraDeReciclaje::where('id_fk', $id_consulta)->get();
    if($registros->isEmpty() == false) { // Verifica si la colección esta vacia
      $hastaC = count($registros) - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) { 
        $registros_id[$contador2] = $registros[$contador2]->id;        
      }
      array_push($registros_id, $id_registro);
    } else {
      $registros_id[0] = $id_registro;
    }
    PapeleraDeReciclaje::destroy($registros_id); 
  }
  public function tablas($registro, $metodo) {
    $exi_llav_prim = 'indefinido';

    switch($registro->tab) {
      case 'users':
        $consulta = \App\Models\User::withTrashed()->findOrFail($registro->papelera_id);
        break;
      case 'sucursales':
        $consulta = \App\Models\Sucursal::withTrashed()->findOrFail($registro->papelera_id);
        $this->sucursalRepo->metodo($metodo, $consulta);
        break;
      case 'roles':
        $consulta = \Spatie\Permission\Models\Role::withTrashed()->findOrFail($registro->papelera_id);
        break;
      case 'catalogos':
        $consulta = \App\Models\Catalogo::withTrashed()->findOrFail($registro->papelera_id);
        break;
      default:
        return abort(403, 'Registro no encontrado.'); // ABORTA LA OPERACIÓN EN CASO DE QUE LA CONSULTA SEA NULL
    }

    return (Object) [
      'consulta'              => $consulta,
      'existe_llave_primaria' => $exi_llav_prim
    ];
  }
}