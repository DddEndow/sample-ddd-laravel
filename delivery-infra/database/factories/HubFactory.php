<?php

declare(strict_types=1);

namespace Database\Factories;

use Delivery\DeliveryInfra\Hub;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

class HubFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hub::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hub_id' => new Ulid(),
            'name' => $this->faker->company,
            'phone_number' => $this->faker->phoneNumber,
        ];
    }
}
