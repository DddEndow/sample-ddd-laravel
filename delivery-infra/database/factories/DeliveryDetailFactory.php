<?php

declare(strict_types=1);

namespace Database\Factories;

use Delivery\DeliveryInfra\DeliveryDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'delivery_id' => DeliveryFactory::factory(),
            'item_id' => ItemFactory::factory(),
            'quantity' => $this->faker->randomDigitNotNull(2),
        ];
    }
}
