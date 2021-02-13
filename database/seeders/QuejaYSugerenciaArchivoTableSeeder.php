<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\QuejaYSugerencia;
use App\Models\Archivo;

class QuejaYSugerenciaArchivoTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $quejas_y_sugerencias = QuejaYSugerencia::get();
    $archivos             = Archivo::get();
    $contador1 = count($archivos) -1;

    foreach($quejas_y_sugerencias as $queja_y_sugerencia) {
      $queja_y_sugerencia->archivos()->sync($archivos[$contador1]);
      $contador1 --;
    }
  }
}
