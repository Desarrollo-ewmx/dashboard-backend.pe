<?php
namespace App\Listeners\layouts;
use App\Events\layouts\ArchivoCargado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// Events
use App\Events\layouts\ArchivosEliminados;

class SubirArchivo { // No implementar ShouldQueue
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
   * @param  ArchivoCargado  $event
   * @return void
   */
  public function handle(ArchivoCargado $event) {
    $event = $event->info;

    // Se encarga de copiar la imagen seleccionada en el servidor y retorna el nombre y la ruta del archivo
    ArchivosEliminados::dispatch($event->rut_arch_ant);

    $nombre_archivo = \Storage::disk('s3')->put($event->ruta,$event->blob_archivo, 'public');

    return [
      'ruta'    => env('PREFIX'),
      'nombre'  => $nombre_archivo
    ];
  }
}