<?php
namespace Database\Seeders;

use App\Models\Sucursal;
use App\Models\SucursalEtiqueta;
use Illuminate\Database\Seeder;
//use database\seeds\NotesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(MenusTableSeeder::class);
        //$this->call(UsersAndNotesSeeder::class);
        /*
        $this->call('UsersAndNotesSeeder');
        $this->call('MenusTableSeeder');
        $this->call('FolderTableSeeder');
        $this->call('ExampleSeeder');
        $this->call('BREADSeeder');
        $this->call('EmailSeeder');
        */

        $this->call([
          PermisoTableSeeder::class,
          RoleTableSeeder::class,
          UserTableSeeder::class,
          SistemaTableSeeder::class,  
          SucursalTableSeeder::class,
          SucursalEtiquetasTableSeeder::class,
          UserSucursalTableSeeder::class,
          ArchivoTableSeeder::class,
          QuejaYSugerenciaTableSeeder::class,
          QuejaYSugerenciaArchivoTableSeeder::class,
          QuejaYSugerenciaSucursalTableSeeder::class,
          CatalogoTableSeeder::class,
          EmailSeeder::class,
          
          /* ========================================== */
          UsersAndNotesSeeder::class,
          MenusTableSeeder::class,
          FolderTableSeeder::class,
          ExampleSeeder::class,
          BREADSeeder::class,
        ]);
    }
}
