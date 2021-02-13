<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Catalogo;
class CatalogoTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Catalogo::factory(800)->create();
  }
}
