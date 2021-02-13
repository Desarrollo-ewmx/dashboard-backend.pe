<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\QuejaYSugerencia;
class QuejaYSugerenciaTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    QuejaYSugerencia::factory(100)->create();
  }
}
