<?php
namespace Database\Factories;
use App\Models\QuejaYSugerencia;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class QuejaYSugerenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuejaYSugerencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
      $id_usuario = $this->faker->randomElement(User::pluck('id'));
      return [
        'tip'       => $this->faker->randomElement(['Queja', 'Sugerencia']),
        'depto'     => $this->faker->randomElement(['Ventas'=>'Ventas','Producción'=>'Producción','Logística'=>'Logística','Facturación'=>'Facturación','Sistema'=>'Sistema','Otro'=>'Otro']),
        'obs'       => 'Pesimo servicio',
        'user_id'   => $id_usuario,
      ];
    }
}
