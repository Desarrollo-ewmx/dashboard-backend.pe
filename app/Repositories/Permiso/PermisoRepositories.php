<?php
namespace App\Repositories\Permiso;
// Models
use Spatie\Permission\Models\Permission;
// Events
use App\Events\layouts\ActividadesRegistradas;
// Otros
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PermisoRepositories implements PermisoInterface {
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate) {
    $db = DB::table('permissions')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->select('id', 'mod', 'nom', 'desc', 'created_at');

    if(isset($columnFilter['id'])) {
      $db->where('id', 'like', '%'.$columnFilter['id'].'%');
    }
    if(isset($columnFilter['mod'])) {
      $db->where('mod', 'like', '%'.$columnFilter['mod'].'%');
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
            ->orWhere('mod', 'like', '%'.$tableFilter.'%')
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
        case 'mod':
          $db->orderBy('mod', $sortCase);
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
  public function getFindOrFail($id_permiso, $relaciones) {
    return Permission::with($relaciones)
        ->select(['id', 'mod', 'nom', 'desc', 'created_at_reg', 'updated_at_reg', 'created_at', 'updated_at'])
        ->findOrFail($id_permiso);
  }
  public function update($request, $id_permiso) {
    $permiso        = $this->getFindOrFail($id_permiso, []);
    $permiso->desc  = $request->desc;
   
    if($permiso->isDirty()) {
      $info = (object) [
        'modulo'=>'Permisos', 'modelo'=>'Spatie\Permission\Models\Permission', 'ruta'=>'Detalles Permiso', 'permisos'=>'rol.show,rol.edit', 'request'=>$permiso,
        'campos'  => [['desc', 'Descripción']]];
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ActividadesRegistradas::dispatch($info); 
      $permiso->updated_at_reg  = auth()->user()->email_registro;
    }
    $permiso->save();

    return $permiso;
  }
  public function getAllCache() {
    $permisos = Cache::rememberForever('permisos', function() {
      return Permission::get(['id', 'mod', 'nom', 'desc']);
    });
    return $permisos;
  }
  public function eliminarCache() {
    Cache::pull('permisos');
  }
}