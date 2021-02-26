<?php
namespace App\Http\Controllers\Imagen;
use App\Http\Controllers\Controller;
// Request
use App\Http\Requests\Imagen\StoreOneImagenRequest;
use App\Http\Requests\Imagen\StoreManyImagenRequest;
// Events
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
use App\Events\layouts\ActividadRegistrada;
// Repositories
use App\Repositories\Sucursal\SucursalRepositories;

class ImagenController extends Controller {
  protected $sucursalRepo;
  public function __construct(SucursalRepositories $sucursalRepositories) {
    $this->sucursalRepo = $sucursalRepositories;
  }
  public function destroy($opcion, $id) {
    switch($opcion) {
      case 'sucursales':
        $model        = $this->sucursalRepo->getFindOrFailCache($id);
        $ruta_nombre  = [$model->log_nom];

        $modul  = 'Sucursales';
        $mode  = 'App\Models\Sucursal';
        $rut    = 'Detalles Sucursal';
        $perm   = 'sucursal.show,sucursal.edit';
        $camp   = 'Archivo';
        $val   = ['Archivo en existencia', 'Archivo eliminado'];
        break;
    }
    ArchivosEliminados::dispatch($ruta_nombre);


    $info = (object) ['modulo'=>$modul, 'modelo'=>$mode, 'ruta'=>$rut, 'permisos'=>$perm, 'id'=>$model->id,'campo'=>$camp, 'valores'=>$val];
    // Dispara el evento registrado en App\Providers\EventServiceProvider.php
    ActividadRegistrada::dispatch($info);
    $model->updated_at_reg  = auth()->user()->email_registro;


    
    switch($opcion) {
      case 'sucursales':
        $model->log_rut	= null;
        $model->log_nom = null;
        $model->save();
        $this->sucursalRepo->eliminarCache($id);
        break;
    }
    return response()->json(['ruta'=>null,'nombre'=>null], 200);
  }
  public function storeOne(StoreOneImagenRequest $request, $opcion, $id) {
		if($request->hasfile('file')) {
			switch($opcion) {
				case 'sucursales':
					$model	= $this->sucursalRepo->getFindOrFailCache($id);
					$info		= (object) ['blob_archivo'=>$request->file('file'), 'ruta'=>'sucursal/'.$model->id, 'nombre'=>'sucursal-'.time(), 'rut_arch_ant'=>[$model->log_nom]];
					break;
			}

      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
		  $archivo = ArchivoCargado::dispatch($info);

      switch($opcion) {
				case 'sucursales':
					$model->log_rut	= $archivo[0]['ruta'];
          $model->log_nom = $archivo[0]['nombre'];
          $model->save();
          $rut_arc= $model->log_rut;
          $nom_arc=$model->log_nom;
          $this->sucursalRepo->eliminarCache($id);
					break;
			}
		}
    
    return response()->json(['ruta'=>$rut_arc,'nombre'=>$nom_arc], 200);
  }
  public function storeMany(StoreManyImagenRequest $request, $opcion, $id) {
  }
}