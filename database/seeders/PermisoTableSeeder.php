<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoTableSeeder extends Seeder {
  public function run() {
// PERMISOS DEL MÓDULO ACTIVIDADES
    Permission::create([
      //    'id'              => 25,
      'mod'             => 'Actividades',
      'nom'             => "Ver detalles por registro",
      'name'				    => 'actividad.show',
      'desc'            => "Ver solo los detalles de los registros a los que se le tiene acceso",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 25,
      'mod'             => 'Actividades',
      'nom'             => "Ver detalles",
      'name'				    => 'actividad.fullShow',
      'desc'            => "Ver detalles de cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO SUCURSALES
    Permission::create([
  //    'id'              => 24,
      'mod'             => 'Sucursales',
      'nom'             => "Registrar nuevo",
      'name'				    => 'sucursal.create',
      'desc'            => "Crear nuevo registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 25,
      'mod'             => 'Sucursales',
      'nom'             => "Ver detalles",
      'name'				    => 'sucursal.show',
      'desc'            => "Ver detalles de cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 26,
      'mod'             => 'Sucursales',
      'nom'             => "Editar registro",
      'name'				    => "sucursal.edit",
      'desc'            => "Editar cualquier dato de un registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 27,
      'mod'             => 'Sucursales',
      'nom'             => "Eliminar registro",
      'name'				    => "sucursal.destroy",
      'desc'            => "Eliminar cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
// PERMISOS DEL MÓDULO ROLES
    Permission::create([
  //    'id'              => 24,
      'mod'             => 'Roles',
      'nom'             => "Registrar nuevo",
      'name'				    => 'rol.create',
      'desc'            => "Crear nuevo registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 25,
      'mod'             => 'Roles',
      'nom'             => "Ver detalles",
      'name'				    => 'rol.show',
      'desc'            => "Ver detalles de cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 26,
      'mod'             => 'Roles',
      'nom'             => "Editar registro",
      'name'				    => "rol.edit",
      'desc'            => "Editar cualquier dato de un registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 27,
      'mod'             => 'Roles',
      'nom'             => "Eliminar registro",
      'name'				    => "rol.destroy",
      'desc'            => "Eliminar cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    
/*
// PERMISOS DEL MÓDULO CATÁLOGOS
    Permission::create([
  //    'id'              => 24,
      'mod'             => 'Catálogos',
      'nom'             => "Registrar nuevo",
      'name'				    => 'catalogo.create',
      'desc'            => "Crear nuevo registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 25,
      'mod'             => 'Catálogos',
      'nom'             => "Ver detalles",
      'name'				    => 'catalogo.show',
      'desc'            => "Ver detalles de cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 26,
      'mod'             => 'Catálogos',
      'nom'             => "Editar registro",
      'name'				    => "catalogo.edit",
      'desc'            => "Editar cualquier dato de un registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 27,
      'mod'             => 'Catálogos',
      'nom'             => "Eliminar registro",
      'name'				    => "catalogo.destroy",
      'desc'            => "Eliminar cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    // PERMISOS DEL MÓDULO USUARIOS
    Permission::create([
  //    'id'              => 23,
      'mod'             => 'Usuarios',
      'nom'             => "Navegar por tabla",
      'name'				    => 'usuario.index',
      'desc'            => "Lista y navega por todos los registros",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 24,
      'mod'             => 'Usuarios',
      'nom'             => "Registrar nuevo",
      'name'				    => 'usuario.create',
      'desc'            => "Crear nuevo registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 25,
      'mod'             => 'Usuarios',
      'nom'             => "Ver detalles",
      'name'				    => 'usuario.show',
      'desc'            => "Ver detalles de cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 26,
      'mod'             => 'Usuarios',
      'nom'             => "Editar registro",
      'name'				    => "usuario.edit",
      'desc'            => "Editar cualquier dato de un registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 27,
      'mod'             => 'Usuarios',
      'nom'             => "Eliminar registro",
      'name'				    => "usuario.destroy",
      'desc'            => "Eliminar cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
  // PERMISOS DEL MÓDULO CLIENTE
    Permission::create([
      'id'              => 28,
      'mod'             => 'Clientes',
      'nom'             => "Navegar por tabla",
      'name'				    => 'cliente.index',
      'desc'            => "Lista y navega por todos los registros",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 29,
    'mod'             => 'Clientes',
      'nom'             => "Registrar nuevo",
      'name'				    => 'cliente.create',
      'desc'            => "Crear nuevo registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 30,
      'mod'             => 'Clientes',
      'nom'             => "Ver detalles",
      'name'				    => 'cliente.show',
      'desc'            => "Ver detalles de cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 31,
      'mod'             => 'Clientes',
      'nom'             => "Editar registro",
      'name'				    => "cliente.edit",
      'desc'            => "Editar cualquier dato de un registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Permission::create([
  //    'id'              => 32,
      'mod'             => 'Clientes',
      'nom'             => "Eliminar registro",
      'name'				    => "cliente.destroy",
      'desc'            => "Eliminar cualquier registro",
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    */
  }
}
