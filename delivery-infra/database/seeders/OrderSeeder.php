<?php

declare(strict_types=1);

namespace Delivery\Infra\Database\Seeders;

use Delivery\Infra\Models\Order;
use Delivery\Infra\Models\OrderDetail;
use Illuminate\Database\Seeder;

final class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(10)
            ->create(['scheduled_delivery_datetime' => null])
            ->each(function (Order $order) {
                OrderDetail::factory()->count(3)->create([
                    'order_id' => $order->order_id,
                    'production_id' => null,
                    'delivery_id' => null
                ]);
            });
    }
}
