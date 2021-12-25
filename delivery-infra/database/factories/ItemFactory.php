<?php

declare(strict_types=1);

namespace Database\Factories;

use Delivery\DeliveryInfra\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => new Ulid(),
            'name' => $this->faker->name,
            'price' => $this->faker->randomDigitNotNull(5),
        ];
    }
}
