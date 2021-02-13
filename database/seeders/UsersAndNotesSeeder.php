<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersAndNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
        $numberOfUsers = 1000;
        $numberOfNotes = 5000;
        $usersIds = array();
        $statusIds = array();
      
       
        /*  insert status  */
        DB::table('status')->insert([
            'name' => 'ongoing',
            'class' => 'primary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'stopped',
            'class' => 'secondary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'completed',
            'class' => 'success',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'expired',
            'class' => 'warning',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        /*  insert users   */
        for($i = 0; $i<$numberOfUsers; $i++){
          $email = $faker->unique()->safeEmail();
          $user = \App\Models\User::create([
            'id_suc_act'        => 2,
            'reg_tab_acces'     => true,
            'notif'             => true,
            'name'              => $faker->name(),
            'apell'             => $faker->lastName,
            'email_registro'    => $email,
            'email'             => $email,
            'email_verified_at' => now(),
            'tel_mov'           => '('.$faker->numberBetween(111, 999).')'.' '.$faker->numberBetween(111, 999).'-'.$faker->numberBetween(1111, 9999),
            'password'          => '$2y$10$CVbZ5SZrZTqma7H8rd6i2OM5uYrU5z3y8GODB3AZp4wj2fTxwyr8W', // Password2
            'menuroles'         => 'user',
            'remember_token'    => \Str::random(10),
            'asig_reg'          => 'desarrolloweb.ewmx@gmail.com',
            'created_at_reg'    => 'desarrolloweb.ewmx@gmail.com'
          ]);
          $user->assignRole('user');
          array_push($usersIds, $user->id);
        }
        /*  insert notes  */
        DB::beginTransaction();
        for($i = 0; $i<$numberOfNotes; $i++){
            $noteType = $faker->word();
            if(random_int(0,1)){
                $noteType .= ' ' . $faker->word();
            }
            DB::table('notes')->insert([
                'title'         => $faker->sentence(4,true),
                'content'       => $faker->paragraph(3,true),
                'status_id'     => $statusIds[random_int(0,count($statusIds) - 1)],
                'note_type'     => $noteType,
                'applies_to_date' => $faker->date(),
                'users_id'      => $usersIds[random_int(0,$numberOfUsers-1)]
            ]);
        }
        DB::commit();
    }
}