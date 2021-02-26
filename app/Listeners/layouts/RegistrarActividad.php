<?php
namespace App\Listeners\layouts;
use App\Events\layouts\ActividadRegistrada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
//Models
use App\Models\Actividad;

class RegistrarActividad {
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
   * @param  ActividadRegistrada  $event
   * @return void
   */
  public function handle(ActividadRegistrada $event) {
    // Función que me guarda el registro de la actividad que hizo el usuario (Campos modificados)
    // Importante: En esta funcion se guardan los cambios para los campos anterior y nuevo dependiendo lo que mande en controlador
    $event = $event->info;

    $actividad                  = new Actividad();
    $actividad->user_id         = auth()->user()->id;
    $actividad->actividad_id    = $event->id;
    $actividad->actividad_type  = $event->modelo;
    $actividad->mod             = $event->modulo;
    $actividad->rut             = $event->ruta;
    $actividad->perm            = $event->permisos;
    $actividad->inpu            = $event->campo;
    $actividad->ant             = $event->valores[0];
    $actividad->nuev            = $event->valores[1];
    $actividad->save();
  }
}
