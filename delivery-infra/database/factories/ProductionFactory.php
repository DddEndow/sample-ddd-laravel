<?php

declare(strict_types=1);

namespace Delivery\Infra\Database\Factories;

use Delivery\Infra\Models\Production;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

class ProductionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Production::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'production_id' => new Ulid(),
            'production_factory_id' => ProductionFactoryFactory::factory(),
            'scheduled_creation_datetime' => $this->faker->dateTime,
            'creation_completion_datetime' => $this->faker->dateTime,
        ];
    }
}
