<?php

declare(strict_types=1);

namespace Database\Factories;

use Delivery\DeliveryInfra\Delivery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

class DeliveryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Delivery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'delivery_id' => new Ulid(),
            'store_id' => StoreFactory::factory(),
            'scheduled_delivery_datetime' => $this->faker->dateTime,
            'delivery_completion_datetime' => $this->faker->dateTime,
        ];
    }
}
