<?php

declare(strict_types=1);

namespace Delivery\Infra\Database\Seeders;

use Delivery\Infra\Models\ProductionFactory;
use Delivery\Infra\Models\Store;
use Illuminate\Database\Seeder;

final class HubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductionFactory::factory()->count(10)->create();
        Store::factory()->count(10)->create(
            [
                'route_code' => null,
                'delivery_order' => null
            ]
        );
    }
}
