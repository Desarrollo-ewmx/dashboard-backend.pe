<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\RoleHierarchy;

class RoleTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $rolPruebas = Role::create([
      'nom'				      => 'Pruebas',
      'name'            => 'pruebas',
      'desc'            => "Rol para realizar pruebas",
      'asig_reg'        => 'desarrolloweb.ewmx@gmail.com',
      'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    $rolPruebas->syncPermissions([1,2,3,4,5]);
    Role::create([
      'nom'				      => 'Cliente',
      'name'            => 'cliente',
      'desc'            => "Acceso especial como cliente",
      'asig_reg'        => 'desarrolloweb.ewmx@gmail.com',
      'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Role::create([
      'nom'				      => 'Desarrollador',
      'name'				    => 'desarrollador',
      'desc'            => 'Administrador de todo el sistema',
      'asig_reg'        => 'desarrolloweb.ewmx@gmail.com',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    Role::create([
      'nom'				      => 'Sin acceso al sistema',
      'name'				    => 'sinAccesoAlSistema',
      'desc'            => 'No tiene permiso de acceder al sistema',
      'asig_reg'        => 'desarrolloweb.ewmx@gmail.com',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);

/* ========================================== */
    $adminRole = Role::create([
      'nom'				      => 'Administrador',
      'name'            => 'admin',
      'desc'            => '',
      'asig_reg'        => 'desarrolloweb.ewmx@gmail.com',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    RoleHierarchy::create([
      'role_id' => $adminRole->id,
      'hierarchy' => 1,
    ]);
    
    $userRole = Role::create([
      'nom'				      => 'Usuario',
      'name'            => 'user',
      'desc'            => '',
      'asig_reg'        => 'desarrolloweb.ewmx@gmail.com',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    RoleHierarchy::create([
      'role_id' => $userRole->id,
      'hierarchy' => 2,
    ]);
    
    $guestRole = Role::create([
      'nom'				      => 'Guest',
      'name'            => 'guest',
      'desc'            => '',
      'asig_reg'        => 'desarrolloweb.ewmx@gmail.com',
      'created_at_reg'	=> 'desarrolloweb.ewmx@gmail.com',
    ]);
    RoleHierarchy::create([
      'role_id' => $guestRole->id,
      'hierarchy' => 3,
    ]);
  }
}
