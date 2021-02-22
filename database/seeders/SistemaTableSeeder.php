<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Sistema;
class SistemaTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Sistema::create([
      'id'                  => 1,
      'emp'                 => 'Proyecto S.A. de C.V.',
      'emp_abrev'           => 'Proyecto',
      'year_de_ini'         => '1990-10-02',
      'log_rut'		          => env('PREFIX'),
      'log_nom'			        => 'sistema/EVOW9oEA18QXPuEhaskLe1BFDiqiDEYlqPvOrosG.png',
      'img_login_rut'       => env('PREFIX'),
      'img_login_nom'       => 'sistema/logo-blanco-1582580735.png',
      'def_img_perf_rut'    => env('PREFIX'),
      'def_img_perf_nom'    => 'sistema/default-perfil-1582134710.png',
      'def_img_rut'         => env('PREFIX'),
      'def_img_nom'         => 'sistema/default-imagen-51419854.png',
      'img_cons_rut'        => env('PREFIX'),
      'img_cons_nom'        => 'sistema/en-construccion-1582134710.png',
      'plant_usu_bien'      => 1,
      'plant_cli_bien'      => 2,
      'plant_per_camb_pass' => 3,
      'plant_sis_rest_pass' => 4,
      'created_at_reg'	    => 'desarrolloweb.ewmx@gmail.com',
    ]);
  }
}
