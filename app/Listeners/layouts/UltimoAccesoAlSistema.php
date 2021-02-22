<?php
namespace App\Listeners\layouts;
use App\Events\layouts\RegistroUltimoAccesoAlSistema;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UltimoAccesoAlSistema {
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
   * @param  RegistroUltimoAccesoAlSistema  $event
   * @return void
   */
  public function handle(RegistroUltimoAccesoAlSistema $event) {
    // REGISTRA LA FECHA DE LA ULYIMA VEZ QUE ACCEDIO AL SISTEMA
    $event->user->last_login  = $event->user->login;
    $event->user->login       = new \DateTime;
    $event->user->save();
  }
}
