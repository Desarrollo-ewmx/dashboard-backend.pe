<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use  App\Models\SucursalEtiqueta;
use  App\Models\Sucursal;

class SucursalEtiquetasTableSeeder extends Seeder{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $sucursales = Sucursal::select(['id', 'suc'])->where('id', '!=', 1)->get();
    $contador = 0;
    foreach($sucursales as $sucursal) {
      SucursalEtiqueta::create([
        'tip'             => 'Correo',
        'value'           => 'Ventas'.$contador,
        'text'            => 'ventas@ejemplo.com',
        'url'             => null,
        'sucursal_id'     => $sucursal->id,
        'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
      ]);
      SucursalEtiqueta::create([
        'tip'             => 'Correo',
        'value'           => 'Ventas 2'.$contador,
        'text'            => 'ventas2@ejemplo.com',
        'url'             => null,
        'sucursal_id'     => $sucursal->id,
        'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
      ]);
      SucursalEtiqueta::create([
        'tip'             => 'Teléfono',
        'value'           => 'Conmutador'.$contador,
        'text'            => '(55) 1234-1234',
        'url'             => null,
        'sucursal_id'     => $sucursal->id,
        'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
      ]);
      SucursalEtiqueta::create([
        'tip'             => 'Teléfono',
        'value'           => 'Ventas'.$contador,
        'text'            => '(55) 4571-5014',
        'url'             => null,
        'sucursal_id'     => $sucursal->id,
        'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
      ]);
      SucursalEtiqueta::create([
        'tip'             => 'Red social',
        'value'           => null,
        'text'            => 'Facebook'.$contador,
        'url'             => 'https://es-la.facebook.com/',
        'sucursal_id'     => $sucursal->id,
        'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
      ]);
      SucursalEtiqueta::create([
        'tip'             => 'Red social',
        'value'           => null,
        'text'            => 'Twitter'.$contador,
        'url'             => 'https://twitter.com/',
        'sucursal_id'     => $sucursal->id,
        'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
      ]);
      SucursalEtiqueta::create([
        'tip'             => 'Red social',
        'value'           => '',
        'text'            => 'Youtube'.$contador,
        'url'             => 'https://www.youtube.com/',
        'sucursal_id'     => $sucursal->id,
        'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
      ]);
      SucursalEtiqueta::create([
        'tip'             => 'Red social',
        'value'           => '',
        'text'            => 'Instagram'.$contador,
        'url'             => 'https://www.instagram.com/',
        'sucursal_id'     => $sucursal->id,
        'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
      ]);
      $contador ++;
    }
  }
}
