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
    $this->sucursalRepo                   = $sucursalRepositories;
  }
  public function papeleraAsignadoFindOrFailById($id_registro) {
    $id_registro = $this->serviceCrypt->decrypt($id_registro);
    $registro = PapeleraDeReciclaje::asignado(auth()->user()->registros_tab_acces, auth()->user()->email_registro)->findOrFail($id_registro);
    return $registro;
  }
  public function getPagination($request) {
    return PapeleraDeReciclaje::asignado(auth()->user()->registros_tab_acces, auth()->user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
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
  public function destroy($id_registro) {
    try { DB::beginTransaction();
      $registro   = $this->papeleraAsignadoFindOrFailById($id_registro);
      $resultado  = $this->tablas($registro, 'destroy');
      $resultado['consulta']->forceDelete();
      $this->destroyAllPapeleraByIdFk($registro->id, $resultado['consulta']->id);
      DB::commit();
      return $registro;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function restore($id_registro) {
    try { DB::beginTransaction();
      $registro = $this->papeleraAsignadoFindOrFailById($id_registro);
      $resultado = $this->tablas($registro, 'restore');
      if($resultado['existe_llave_primaria'] == false) { DB::commit();return false; }
      $resultado['consulta']->restore();
      $this->destroyAllPapeleraByIdFk($registro->id, $resultado['consulta']->id);
      DB::commit();
      return $registro;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroyAllPapeleraByIdFk($id_registro, $id_resultado) {
    $registros =  PapeleraDeReciclaje::where('id_fk', $id_resultado)->get();
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
    $existe_llave_primaria = 'indefinido';
    if($registro->tab == 'users') {
      $consulta = \App\User::withTrashed()->findOrFail($registro->id_reg);
      $this->usuariosRepo->metodo($metodo, $consulta);

      if($consulta->acceso == '2') { // 2 = Cliente, 1 = Usuario
        //ELIMINA LAS COTIZACIONES CON TODA SU INFORMACIÓN
        $cotizaciones = \App\Models\Cotizacion::with(['armados'])->withTrashed()->where('user_id', $consulta->id)->get();
        foreach($cotizaciones as $cotizacion) {
          $this->cotizacionesRepo->metodo($metodo, $cotizacion);
        }

        // ELIMINA LOS PEDIDOS CON TODA SU INFORMACIÓN
        $pedidos = \App\Models\Pedido::with(['armados', 'pagos'])->withTrashed()->where('user_id', $consulta->id)->get();
        foreach($pedidos as $pedido) {
          $this->pedidosRepo->metodo($metodo, $pedido);
        }
      }

      $qys = \App\Models\QuejaYSugerencia::with(['archivos'=> function ($query) {
        $query->withTrashed();
      }])->withTrashed()->where('user_id', $consulta->id)->get();
      $this->quejasYSugerenciasRepo->metodo($metodo, $qys);
    }
    if($registro->tab == 'roles') {
      $consulta = \Spatie\Permission\Models\Role::withTrashed()->findOrFail($registro->id_reg);
    }

    if($registro->tab == 'catalogos') {
      $consulta = \App\Models\Catalogo::withTrashed()->findOrFail($registro->id_reg);
    }

  

    if($consulta == null) {return abort(403, 'Registro no encontrado.');} // ABORTA LA OPERACIÓN EN CASO DE QUE LA CONSULTA SEA NULL
    return [
      'consulta'              => $consulta,
      'existe_llave_primaria' => $existe_llave_primaria
    ];
  }
}