<?php
namespace App\Repositories\Actividad;
//Models
use App\Models\Actividad;
// Otros
use Illuminate\Support\Facades\DB;

class ActividadRepositories implements ActividadInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $id_modelo, $startDate, $endDate) {
    $db = DB::table('actividades')
    ->whereNull('actividades.deleted_at')
    ->whereBetween('actividades.created_at', [$startDate, $endDate])
    ->join('users', 'users.id', '=', 'actividades.user_id')
    ->select('actividades.*', 'users.name', 'users.email_registro');
  
    if($id_modelo != null) {
      $db->where('actividades.actividad_id', $id_modelo);
    }
    
    if(isset($columnFilter['id'])) {
      $db->where('actividades.id', 'like', '%'.$columnFilter['id'].'%');
    }
    if(isset($columnFilter['email_registro'])) {
      $db->where(function ($query) use ($columnFilter) {
        $query->where('users.email_registro', 'like', '%'.$columnFilter['email_registro'].'%')
        ->orWhere('users.name', 'like', '%'.$columnFilter['email_registro'].'%');
      });
    }
    if(isset($columnFilter['mod'])) {
      $db->where('actividades.mod', 'like', '%'.$columnFilter['mod'].'%');
    }
    if(isset($columnFilter['actividad_id'])) {
      $db->where('actividades.actividad_id', 'like', '%'.$columnFilter['actividad_id'].'%');
    }
    if(isset($columnFilter['inpu'])) {
      $db->where('actividades.inpu', 'like', '%'.$columnFilter['inpu'].'%');
    }
    if(isset($columnFilter['ant'])) {
      $db->where('actividades.ant', 'like', '%'.$columnFilter['ant'].'%');
    }
    if(isset($columnFilter['nuev'])) {
      $db->where('actividades.nuev', 'like', '%'.$columnFilter['nuev'].'%');
    }
    if(isset($columnFilter['created_at'])) {
      $db->where('actividades.created_at', 'like', '%'.$columnFilter['created_at'].'%');
    }

    if(strlen($tableFilter) > 0 ) {
      $db->where(function ($query) use ($tableFilter) {
        $query->where('actividades.id', 'like', '%'.$tableFilter.'%')
            ->orWhere('users.email_registro', 'like', '%'.$tableFilter.'%')
            ->orWhere('users.name', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.mod', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.actividad_id', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.inpu', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.ant', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.nuev', 'like', '%'.$tableFilter.'%')
            ->orWhere('actividades.created_at', 'like', '%'.$tableFilter.'%');
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
          $db->orderBy('actividades.id', $sortCase);
        break;
        case 'email_registro':
          $db->orderBy('users.name', $sortCase);
        break;
        case 'mod':
          $db->orderBy('actividades.mod', $sortCase);
        break;
        case 'actividad_id':
          $db->orderBy('actividades.actividad_id', $sortCase);
        break;
        case 'inpu':
          $db->orderBy('actividades.inpu', $sortCase);
        break;
        case 'ant':
          $db->orderBy('actividades.ant', $sortCase);
        break;
        case 'nuev':
          $db->orderBy('actividades.nuev', $sortCase);
        break;
        case 'created_at':
          $db->orderBy('actividades.created_at', $sortCase);
        break;
        default:
          $db->orderBy('actividades.id', 'desc');
          break;
      }
    }
    return $db->paginate($itemsLimit);
  }
}