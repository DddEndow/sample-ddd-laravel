<?php

declare(strict_types=1);

namespace Database\Factories;

use Delivery\DeliveryInfra\Production;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Production::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hub_id' => HubFactory::factory(),
            'capacity' => $this->faker->randomDigitNotNull(3),
        ];
    }
}