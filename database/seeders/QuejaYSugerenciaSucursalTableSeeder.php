<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\QuejaYSugerencia;
use App\Models\Sucursal;

class QuejaYSugerenciaSucursalTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $quejas_y_sugerencias = QuejaYSugerencia::get();
    $sucursales = Sucursal::where('id', '!=', 1)->get();
    $hastaC = count($sucursales) - 1;
    $contador1 = 0;

    foreach($quejas_y_sugerencias as $quejas_y_sugerencia) {
      $quejas_y_sugerencia->sucursales()->sync($sucursales[$contador1]->id);
      $contador1 ++;
      if($contador1 == $hastaC+1) {
        $contador1 = 0;
      }
    }
  }
}
