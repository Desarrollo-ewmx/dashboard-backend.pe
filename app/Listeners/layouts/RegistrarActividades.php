<?php
namespace App\Listeners\layouts;
use App\Events\layouts\ActividadesRegistradas;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
//Models
use App\Models\Actividad;

class RegistrarActividades {
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct() {
    //
  }

  /**
   * Handle the event.
   *
   * @param  ActividadesRegistradas  $event
   * @return void
   */
  public function handle(ActividadesRegistradas $event) {
    // Función que me guarda el registro de las actividad que hizo el usuario (Campos modificados)
    // Importante: En esta funcion se guardan los cambios conforme al campo anterior y nuevo como lo marca eloquent
    $event = $event->info;
    $camposBD = ['user_id', 'actividad_id', 'actividad_type', 'mod', 'rut', 'perm', 'inpu', 'ant', 'nuev'];
    $hastaC = count($event->campos);
    $datos = null;
    $contador3 = 0;
    
    for($contador2=0;$contador2<$hastaC;$contador2++) {
      if($event->request->isDirty($event->campos[$contador2])) {
        $datos[$contador2][$camposBD[$contador3]] =  auth()->user()->id;
        $contador3 ++;
        $datos[$contador2][$camposBD[$contador3]] =  $event->request->id;
        $contador3 ++;
        $datos[$contador2][$camposBD[$contador3]] =  $event->modelo;
        $contador3 ++;
        $datos[$contador2][$camposBD[$contador3]] =  $event->modulo;
        $contador3 ++;
        $datos[$contador2][$camposBD[$contador3]] =  $event->ruta;
        $contador3 ++;
        $datos[$contador2][$camposBD[$contador3]] =  $event->permisos;
        $contador3 ++;
        $datos[$contador2][$camposBD[$contador3]] =  $event->campos[$contador2][1];
        $contador3 ++;
        $datos[$contador2][$camposBD[$contador3]] =  $event->request->getOriginal($event->campos[$contador2][0]);
        $contador3 ++;
        $datos[$contador2][$camposBD[$contador3]] =  $event->request->getAttribute($event->campos[$contador2][0]);
        $contador3 = 0;
      }
    }
    Actividad::insert($datos);
  }
}
