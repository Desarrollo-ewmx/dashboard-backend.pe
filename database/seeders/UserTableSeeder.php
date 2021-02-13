<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      $user = User::create([
        'id'                => 1,
        'img_rut'           => env('PREFIX'),
        'img_nom'           => 'perfil/perfil-1582071257.png',
        'id_suc_act'        => 1,
        'reg_tab_acces'     => true,
        'notif'             => true,
        'name'              => 'Aaron Josue',
        'apell'             => 'Sánchez Mendoza',
        'email_registro'    => 'desarrolloweb.ewmx@gmail.com',
        'email'             => 'desarrolloweb.ewmx@gmail.com',
        'email_verified_at' => now(),
        'tel_mov'           => '(551) 755-2250',
        'password'          => '$2y$10$CVbZ5SZrZTqma7H8rd6i2OM5uYrU5z3y8GODB3AZp4wj2fTxwyr8W', // Password2
        'menuroles'         => 'user,admin',
        'remember_token'    => \Str::random(10),
        'asig_reg'          => 'desarrolloweb.ewmx@gmail.com',
        'created_at_reg'    => 'desarrolloweb.ewmx@gmail.com'
      ]);
      $user->assignRole(['admin','user','desarrollador']);
      $user = User::create([
        'id'                => 2,
        'id_suc_act'        => 1,
        'reg_tab_acces'     => true,
        'notif'             => true,
        'name'              => 'Usuario',
        'apell'             => 'Pruebas',
        'email_registro'    => 'pruebas@admin.com',
        'email'             => 'pruebas@admin.com',
        'email_verified_at' => now(),
        'tel_mov'           => '(551) 000-0000',
        'password'          => '$2y$10$CVbZ5SZrZTqma7H8rd6i2OM5uYrU5z3y8GODB3AZp4wj2fTxwyr8W', // Password2
        'menuroles'         => 'user,admin',
        'remember_token'    => \Str::random(10),
        'asig_reg'          => 'desarrolloweb.ewmx@gmail.com',
        'created_at_reg'    => 'desarrolloweb.ewmx@gmail.com'
      ]);
      $user->assignRole(['admin', 'pruebas']);
    }
}
