<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\models\User;
use App\models\Sucursal;

class UserSucursalTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $usuarios = User::get();
    $sucursales = Sucursal::get();
    $hastaC = count($sucursales) - 1;
    $contador1 = 0;

    $sucursales_id = [];
    foreach($sucursales as $sucursal) {
      array_push($sucursales_id, $sucursal->id) ;
    }

    foreach($usuarios as $usuario) {
      $usuario->id_suc_act = $sucursales[$contador1]->id;
      $usuario->save();
      $id_sucursal = $sucursales[$contador1]->id;

      //Si e rol del usuario es desarrollador se le asignaran todas las sucursales
      if($usuario->hasRole(config('app.rol_desarrollador'))) {
        $id_sucursal = $sucursales_id;
      }

      $usuario->sucursales()->sync($id_sucursal);
      $contador1 ++;
      if($contador1 == $hastaC+1) {
        $contador1 = 0;
      }
    }
  }
}
