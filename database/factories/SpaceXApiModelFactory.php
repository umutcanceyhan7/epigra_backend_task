<?php

namespace Database\Factories;

use App\Models\SpaceXApiModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceXApiModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpaceXApiModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'capsule_serial' => 'C' . $this->faker->numberBetween(300, 999),
            'capsule_id' => 'dragon' . $this->faker->numberBetween(10, 20),
            'status' => 'retired',
            'original_launch' => '2010-12-08T15:43:00.000Z',
            'original_launch_unix' => '1291822980',
            'missions' => 'a:1:{i:0;a:2:{s:4:"name";s:6:"COTS 1";s:6:"flight";i:7;}}',
            'landings' => '1',
            'type' => 'Dragon 1.0',
            'details' => $this->faker->name(),
            'reuse_count' => '0',
        ];
    }
}
