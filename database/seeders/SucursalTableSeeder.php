<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Sucursal::create([
      'id'              => 1,
      'suc'			        => 'Todas las sucursales', 
      'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Sucursal::create([
      'id'              => 2,
      'log_rut'         => env('PREFIX'),
      'log_nom'				  => 'sucursal/2/GiH9vPTEKy4BDaFO2hHPNVz2mXOptmNOMliIRxC5.png',
      'suc'             => "Polanco",
      'direc'	          => 'Av. San Esteban No. 18 Col. Fraccionamiento el Parque C.P. 53390 Naucalpan Edo. de México.',
      'ser_cot'         => 'COTP-',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Sucursal::create([
      'id'              => 3,
      'log_rut'         => env('PREFIX'),
      'log_nom'				  => 'sucursal/3/GiH9vPTEKy4BDaFO2hHPNVz2mXOptmNOMliIRxC5.png',
      'suc'             => "Toreo",
      'direc'	          => 'Calz. San Esteban 36, San Esteban, C.P. 53768 Naucalpan de Juárez.',
      'ser_cot'         => 'COTT-',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Sucursal::create([
      'id'              => 4,
      'log_rut'         => env('PREFIX'),
      'log_nom'				  => 'sucursal/4/GiH9vPTEKy4BDaFO2hHPNVz2mXOptmNOMliIRxC5.png',
      'suc'             => "Culhuacán",
      'direc'	          => 'Avenida Tlahuac # 4160 Col. Santa María Tomatlan, C.P. 09870 México DF.',
      'ser_cot'         => 'COTC-',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Sucursal::create([
      'id'              => 5,
      'log_rut'         => env('PREFIX'),
      'log_nom'				  => 'sucursal/5/GiH9vPTEKy4BDaFO2hHPNVz2mXOptmNOMliIRxC5.png',
      'suc'             => "Circuito",
      'direc'	          => 'Avenida Río Consulado #4102, Col. Nueva Tenochtitlan, CP: 07880, Del. Gustavo A. Madero.',
      'ser_cot'         => 'COTC-',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);

    Sucursal::factory(1000)->create();
  }
}
