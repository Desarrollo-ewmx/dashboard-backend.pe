<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class BREADSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form')->insert([
            'name' => 'Example',
            'table_name' => 'example',
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'delete' => 1,
            'pagination' => 5
        ]);
        $formId = DB::getPdo()->lastInsertId();
        DB::table('form_field')->insert([
            'name' => 'Title',
            'type' => 'text',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'name'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Description',
            'type' => 'text_area',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'description'
        ]);
        DB::table('form_field')->insert([
            'name' => 'Status',
            'type' => 'relation_select',
            'browse' => 1,
            'read' => 1,
            'edit' => 1,
            'add' => 1,
            'form_id' => $formId,
            'column_name' => 'status_id',
            'relation_table' => 'status',
            'relation_column' => 'name'
        ]);
        $role = Role::where('name', '=', 'guest')->first();
        Permission::create([
          'mod'             => 'Plant',
          'nom'             => 'browse bread '   . $formId,
          'name'            => 'browse bread '   . $formId,
          'desc'            => 'Plant',
          'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
        ]); 
        Permission::create([
          'mod'             => 'Plant',
          'nom'             => 'read bread '     . $formId,
          'name'            => 'read bread '     . $formId,
          'desc'            => 'Plant',
          'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
          ]); 
        Permission::create([
          'mod'             => 'Plant',
          'nom'             => 'edit bread '     . $formId,
          'name'            => 'edit bread '     . $formId,
          'desc'            => 'Plant',
          'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
        ]); 
        Permission::create([
          'mod'             => 'Plant',
          'nom'             => 'add bread '      . $formId,
          'name'            => 'add bread '      . $formId,
          'desc'            => 'Plant',
          'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
        ]); 
        Permission::create([
          'mod'             => 'Plant',
          'nom'             => 'delete bread '   . $formId,
          'name'            => 'delete bread '   . $formId,
          'desc'            => 'Plant',
          'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
        ]); 
        $role->givePermissionTo('browse bread '     . $formId);
        $role->givePermissionTo('read bread '       . $formId);
        $role->givePermissionTo('edit bread '       . $formId);
        $role->givePermissionTo('add bread '        . $formId);
        $role->givePermissionTo('delete bread '     . $formId);
    }
}
