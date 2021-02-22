<?php
namespace App\Repositories\Actividad;
//Models
use App\Models\Actividad;
// Otros
use Illuminate\Support\Facades\DB;

class ActividadRepositories implements ActividadInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $id_modelo) {
    $db = DB::table('actividades')
    ->join('users', 'users.id', '=', 'actividades.user_id')
    ->select('actividades.*', 'users.name', 'users.email_registro');
  
    if($id_modelo != null) {
      $db->where('actividades.actividad_id', $id_modelo);
    }
    
    if( isset($columnFilter['id']) ){
      $db->where('actividades.id', 'like', '%' . $columnFilter['id'] . '%');
    }
    if( isset($columnFilter['mod']) ){
      $db->where('actividades.mod', 'like', '%' . $columnFilter['mod'] . '%');
    }
    if( isset($columnFilter['actividad_id']) ){
      $db->where('actividades.actividad_id', 'like', '%' . $columnFilter['actividad_id'] . '%');
    }
    if( isset($columnFilter['inpu']) ){
      $db->where('actividades.inpu', 'like', '%' . $columnFilter['inpu'] . '%');
    }
    if( isset($columnFilter['email_registro']) ){
      $db->where('users.email_registro', 'like', '%' . $columnFilter['email_registro'] . '%');
    }
    if( isset($columnFilter['ant']) ){
      $db->where('actividades.ant', 'like', '%' . $columnFilter['ant'] . '%');
    }
    if( isset($columnFilter['nuev']) ){
      $db->where('actividades.nuev', 'like', '%' . $columnFilter['nuev'] . '%');
    }
  
    if( strlen($tableFilter) > 0 ){
      $db->where(function ($query) use ($tableFilter) {
        $query->where('actividades.id', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.mod', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.actividad_id', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.inpu', 'like', '%'.$tableFilter.'%')
            ->orWhere('users.email_registro', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.ant', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.nuev', 'like', '%'.$tableFilter.'%');
      });
    }

    if( !empty($sorter) ){
      if($sorter['asc'] === false){
        $sortCase = 'desc';
      }else{
        $sortCase = 'asc';
      }
      switch($sorter['column']){
        case 'actividades.id':
          $db->orderBy('id', $sortCase);
        break;
        case 'actividades.mod':
          $db->orderBy('mod', $sortCase);
        break;
        case 'actividades.actividad_id':
          $db->orderBy('actividad_id', $sortCase);
        break;
        case 'actividades.inpu':
          $db->orderBy('inpu', $sortCase);
        break;
        case 'email_registro':
          $db->orderBy('users.email_registro', $sortCase);
        break;
        case 'actividades.ant':
          $db->orderBy('ant', $sortCase);
        break;
        case 'actividades.nuev':
          $db->orderBy('nuev', $sortCase);
        break;
        default:
          $db->orderBy('actividades.id', 'desc');
          break;
      }
    }
    return $db->paginate($itemsLimit);
  }
}