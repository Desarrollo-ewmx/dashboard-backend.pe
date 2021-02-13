<?php
namespace App\Repositories\Sucursal;
// Models
use App\Models\Sucursal;
// Otros
use Illuminate\Support\Facades\Cache;

class SucursalRepositories implements SucursalInterface {
  public function index($sorter, $tableFilter, $columnFilter, $itemsLimit) {
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
  public function getCacheFindOrFail($id_sucursal) {
    $sucursal = Cache::rememberForever('sucursal-'.$id_sucursal, function() use($id_sucursal){
      return Sucursal::with('etiquetas')->findOrFail($id_sucursal);
    });
    return $sucursal;
  }
  public function store($request) {
    $sucursal = new Sucursal();
    $sucursal->suc = $request->sucursal;
    $sucursal->direc = $request->direccion;
    $sucursal->ser_cot = $request->serie;
    $sucursal->save();

    return $sucursal;
  }
}