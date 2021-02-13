<?php
namespace Database\Factories;
use App\Models\Catalogo;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CatalogoFactory extends Factory {
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Catalogo::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition() {
    $value_vista    = $this->faker->jobTitle;
    $usuario = $this->faker->randomElement(User::pluck('email_registro'));
    return [
      'input'           => $this->faker->randomElement(['Cotizaciones (Serie)' => 'Cotizaciones (Serie)', 'Pedidos (Serie)' => 'Pedidos (Serie)']),
      'value'           => $value_vista,
      'text'            => $value_vista,
      'asig_reg'        => $usuario,
      'created_at_reg'  => $usuario
    ];
  }
}
