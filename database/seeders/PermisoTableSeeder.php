<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
// PERMISOS DEL MÓDULO ACTIVIDADES
    Permission::create([
      //    'id'              => 25,
      'nom'             => "Ver detalles por registro 'Actividades'",
      'name'				    => 'actividad.show',
      'desc'            => "Ver solo los detalles de los registros a los que se le tiene acceso",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 25,
      'nom'             => "Ver detalles 'Actividades'",
      'name'				    => 'actividad.fullShow',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Actividades'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SUCURSALES
      Permission::create([
    //    'id'              => 24,
        'nom'             => "Registrar nuevo 'Sucursales'",
        'name'				    => 'sucursal.create',
        'desc'            => "Crear nuevo registro en el módulo 'Sucursales'",
        'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
      ]);
      Permission::create([
    //    'id'              => 25,
        'nom'             => "Ver detalles 'Sucursales'",
        'name'				    => 'sucursal.show',
        'desc'            => "Ver detalles de cualquier registro del módulo 'Sucursales'",
        'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
      ]);
      Permission::create([
    //    'id'              => 26,
        'nom'             => "Editar registro 'Sucursales'",
        'name'				    => "sucursal.edit",
        'desc'            => "Editar cualquier dato de un registro del módulo 'Sucursales'",
        'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
      ]);
      Permission::create([
    //    'id'              => 27,
        'nom'             => "Eliminar registro 'Sucursales'",
        'name'				    => "sucursal.destroy",
        'desc'            => "Eliminar cualquier registro del módulo 'Sucursales'",
        'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
      ]);
    /*
    // PERMISOS DEL MÓDULO USUARIOS
    Permission::create([
  //    'id'              => 23,
      'nom'             => "Navegar por tabla 'Usuarios'",
      'name'				    => 'usuario.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Usuarios'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 24,
      'nom'             => "Registrar nuevo 'Usuarios'",
      'name'				    => 'usuario.create',
      'desc'            => "Crear nuevo registro en el módulo 'Usuarios'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 25,
      'nom'             => "Ver detalles 'Usuarios'",
      'name'				    => 'usuario.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Usuarios'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 26,
      'nom'             => "Editar registro 'Usuarios'",
      'name'				    => "usuario.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Usuarios'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 27,
      'nom'             => "Eliminar registro 'Usuarios'",
      'name'				    => "usuario.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Usuarios'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
  // PERMISOS DEL MÓDULO CLIENTE
    Permission::create([
      'id'              => 28,
      'nom'             => "Navegar por tabla 'Clientes'",
      'name'				    => 'cliente.index',
      'desc'            => "Lista y navega por todos los registros del módulo 'Clientes'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 29,
      'nom'             => "Registrar nuevo 'Clientes'",
      'name'				    => 'cliente.create',
      'desc'            => "Crear nuevo registro en el módulo 'Clientes'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 30,
      'nom'             => "Ver detalles 'Clientes'",
      'name'				    => 'cliente.show',
      'desc'            => "Ver detalles de cualquier registro del módulo 'Clientes'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 31,
      'nom'             => "Editar registro 'Clientes'",
      'name'				    => "cliente.edit",
      'desc'            => "Editar cualquier dato de un registro del módulo 'Clientes'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 32,
      'nom'             => "Eliminar registro 'Clientes'",
      'name'				    => "cliente.destroy",
      'desc'            => "Eliminar cualquier registro del módulo 'Clientes'",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    */
  }
}
