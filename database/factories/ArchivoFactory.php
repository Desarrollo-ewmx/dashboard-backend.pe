<?php
namespace Database\Factories;
use App\Models\Archivo;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ArchivoFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Archivo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
      $usuario = $this->faker->randomElement(User::pluck('email_registro'));
      return [
        'arch_rut'        => env('PREFIX'),
        'arch_nom'        => $this->faker->name(),
        'created_at_reg'  => $usuario,
      ];
    }
}
