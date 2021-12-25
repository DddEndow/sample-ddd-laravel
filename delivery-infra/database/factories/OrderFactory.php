<?php

declare(strict_types=1);

namespace Database\Factories;

use Delivery\DeliveryInfra\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => new Ulid(),
            'store_id' => StoreFactory::factory(),
            'registration_order_datetime' => $this->faker->dateTime,
            'scheduled_delivery_datetime' => $this->faker->dateTime,
        ];
    }
}
