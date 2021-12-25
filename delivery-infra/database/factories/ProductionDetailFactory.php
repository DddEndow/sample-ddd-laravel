<?php

declare(strict_types=1);

namespace Delivery\Infra\Database\Factories;

use Delivery\Infra\Models\ProductionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductionDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'production_id' => ProductionFactory::factory(),
            'item_id' => ItemFactory::factory(),
            'output' => $this->faker->randomDigitNotNull(2),
        ];
    }
}
