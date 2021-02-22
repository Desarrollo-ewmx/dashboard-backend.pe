<?php
namespace App\Providers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
// Eventos
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
use App\Events\layouts\RegistroUltimoAccesoAlSistema;
// Listener
use App\Listeners\layouts\RegistrarActividad;
use App\Listeners\layouts\SubirArchivo;
use App\Listeners\layouts\EliminarArchivo;
use App\Listeners\layouts\UltimoAccesoAlSistema;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RegistroUltimoAccesoAlSistema::class => [
            UltimoAccesoAlSistema::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ActividadRegistrada::class => [
            RegistrarActividad::class
        ],
        ArchivoCargado::class => [
            SubirArchivo::class
        ],
        ArchivosEliminados::class => [
            EliminarArchivo::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
