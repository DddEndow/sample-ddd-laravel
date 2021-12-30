<?php

declare(strict_types=1);

namespace Delivery\Infra\Database\Factories;

use Delivery\Infra\Models\Hub;
use Delivery\Infra\Models\ProductionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductionFactory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hub_id' => Hub::factory(),
            'capacity' => $this->faker->randomDigitNotNull(3),
        ];
    }
}
