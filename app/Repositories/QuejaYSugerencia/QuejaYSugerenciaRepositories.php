<?php
namespace App\Repositories\QuejaYSugerencia;
// Models
use App\Models\QuejaYSugerencia;
// Events
use App\Events\layouts\ActividadesRegistradas;
// Repositories
use App\Repositories\PapeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\DB;

class QuejaYSugerenciaRepositories implements QuejaYSugerenciaInterface {
  protected $papeleraRepo;
  public function __construct(PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->papeleraRepo = $papeleraDeReciclajeRepositories;
  } 
  public function getPagination($sorter, $tableFilter, $columnFilter, $itemsLimit, $startDate, $endDate) {
    $db = DB::table('quejas_y_sugerencias')
    ->whereBetween('quejas_y_sugerencias.created_at', [$startDate, $endDate])
    ->join('users', 'users.id', '=', 'quejas_y_sugerencias.user_id')
    ->select('quejas_y_sugerencias.id', 'quejas_y_sugerencias.tip', 'quejas_y_sugerencias.depto', 'quejas_y_sugerencias.obs', 'quejas_y_sugerencias.created_at', 'quejas_y_sugerencias.user_id', 'users.name', 'users.email_registro');

    if(isset($columnFilter['id'])) {
      $db->where('quejas_y_sugerencias.id', 'like', '%'.$columnFilter['id'].'%');
    }
    if(isset($columnFilter['email_registro'])) {
      $db->where('users.email_registro', 'like', '%'.$columnFilter['email_registro'].'%');
      $db->orWhere('users.name', 'like', '%'.$columnFilter['email_registro'].'%');
    }
    if(isset($columnFilter['tip'])) {
      $db->where('quejas_y_sugerencias.tip', 'like', '%'.$columnFilter['tip'].'%');
    }
    if(isset($columnFilter['depto'])) {
      $db->where('quejas_y_sugerencias.depto', 'like', '%'.$columnFilter['depto'].'%');
    }
    if(isset($columnFilter['obs'])) {
        $db->where('quejas_y_sugerencias.obs', 'like', '%'.$columnFilter['obs'].'%');
      }
    if(isset($columnFilter['created_at'])) {
      $db->where('quejas_y_sugerencias.created_at', 'like', '%'.$columnFilter['created_at'].'%');
    }
     
    if(strlen($tableFilter) > 0) {
      $db->where(function ($query) use ($tableFilter) {
        $query->where('quejas_y_sugerencias.id', 'like', '%'.$tableFilter.'%')
            ->orWhere('users.email_registro', 'like', '%'.$tableFilter.'%')
            ->orWhere('users.name', 'like', '%'.$tableFilter.'%')
            ->orWhere('quejas_y_sugerencias.tip', 'like', '%'.$tableFilter.'%')
            ->orWhere('quejas_y_sugerencias.depto', 'like', '%'.$tableFilter.'%')
            ->orWhere('quejas_y_sugerencias.obs', 'like', '%'.$tableFilter.'%')
            ->orWhere('quejas_y_sugerencias.created_at', 'like', '%'.$tableFilter.'%');
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
          $db->orderBy('quejas_y_sugerencias.id', $sortCase);
        break;
        case 'email_registro':
          $db->orderBy('users.name', $sortCase);
        break;
        case 'tip':
          $db->orderBy('quejas_y_sugerencias.tip', $sortCase);
        break;
        case 'depto':
          $db->orderBy('quejas_y_sugerencias.depto', $sortCase);
        break;
        case 'obs':
          $db->orderBy('quejas_y_sugerencias.obs', $sortCase);
        break;
        case 'created_at':
          $db->orderBy('quejas_y_sugerencias.created_at', $sortCase);
        break;
        default:
          $db->orderBy('quejas_y_sugerencias.id', 'desc');
          break;
      }
    }
      
    return $db->paginate($itemsLimit);
  }
  public function store($request) {
    $queja_y_sugerencia           = new QuejaYSugerencia();
    $queja_y_sugerencia->tip      = $request->tipo;
    $queja_y_sugerencia->depto    = $request->deprto;
    $queja_y_sugerencia->obs      = $request->obs;
    $queja_y_sugerencia->user_id  = auth()->user()->id;
    $queja_y_sugerencia->save();

    return $queja_y_sugerencia;
  }
  public function getFindOrFail($id_queya_y_sugerencia, $relaciones) {
    return QuejaYSugerencia::with($relaciones)->findOrFail($id_queya_y_sugerencia);
  }
}