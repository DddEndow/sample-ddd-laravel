<?php

declare(strict_types=1);

namespace Delivery\Infra\Database\Factories;

use Delivery\Infra\Models\DeliveryDetail;
use Delivery\Infra\Models\Item;
use Delivery\Infra\Models\Order;
use Delivery\Infra\Models\OrderDetail;
use Delivery\Infra\Models\ProductionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

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
            'order_id' => Order::factory(),
            'order_detail_id' => new Ulid(),
            'item_id' => Item::factory(),
            'production_id' => ProductionDetail::factory(),
            'delivery_id' => DeliveryDetail::factory(),
            'quantity' => $this->faker->randomDigitNotNull(2),
        ];
    }
}
