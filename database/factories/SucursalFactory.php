<?php
namespace Database\Factories;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class SucursalFactory extends Factory {
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Sucursal::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition() {
    $usuario = $this->faker->randomElement(User::pluck('email_registro'));
    return [
      'suc'			        => $this->faker->unique()->name(),
      'direc'           => $this->faker->company,
      'ser_cot'         => $this->faker->tld,
      'created_at_reg'  => $usuario,
    ];
  }
}
