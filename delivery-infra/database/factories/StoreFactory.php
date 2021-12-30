<?php

declare(strict_types=1);

namespace Delivery\Infra\Database\Factories;

use Delivery\Infra\Models\DeliveryRoute;
use Delivery\Infra\Models\Hub;
use Delivery\Infra\Models\Store;
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
            'hub_id' => Hub::factory(),
            'basic_information' => $this->faker->text(50),
            'route_code' => DeliveryRoute::factory(),
            'delivery_order' => $this->faker->randomDigitNotNull(3),
        ];
    }
}
