<?php

declare(strict_types=1);

namespace Database\Factories;

use Delivery\DeliveryInfra\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => OrderFactory::factory(),
            'item_id' => ItemFactory::factory(),
            'production_id' => ProductionDetailFactory::factory(),
            'delivery_id' => DeliveryDetailFactory::factory(),
            'quantity' => $this->faker->randomDigitNotNull(2),
        ];
    }
}
