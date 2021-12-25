<?php

declare(strict_types=1);

namespace Database\Factories;

use Delivery\DeliveryInfra\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hub_id' => HubFactory::factory(),
            'basic_information' => $this->faker->text,
            'route_code' => DeliveryRouteFactory::factory(),
            'delivery_order' => $this->faker->randomDigitNotNull(3),
        ];
    }
}
