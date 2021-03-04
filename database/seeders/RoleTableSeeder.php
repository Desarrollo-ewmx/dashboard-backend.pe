<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder {
  public function run() {
    $rolPruebas = Role::create([
      'nom'				      => 'Pruebas',
      'name'            => 'pruebas',
      'desc'            => "Rol para realizar pruebas",
      'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Role::create([
      'nom'				      => 'Cliente',
      'name'            => 'cliente',
      'desc'            => "Acceso especial como cliente",
      'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Role::create([
      'nom'				      => 'Desarrollador',
      'name'				    => 'desarrollador',
      'desc'            => 'Administrador de todo el sistema',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Role::create([
      'nom'				      => 'Sin acceso al sistema',
      'name'				    => 'sinAccesoAlSistema',
      'desc'            => 'No tiene permiso de acceder al sistema',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);

/* ========================================== */
    $adminRole = Role::create([
      'nom'				      => 'Administrador',
      'name'            => 'admin',
      'desc'            => '',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    $userRole = Role::create([
      'nom'				      => 'Usuario',
      'name'            => 'user',
      'desc'            => '',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    $guestRole = Role::create([
      'nom'				      => 'Guest',
      'name'            => 'guest',
      'desc'            => '',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
  }
}
