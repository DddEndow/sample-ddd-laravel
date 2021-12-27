<?php

declare(strict_types=1);

namespace Delivery\Infra\Database\Seeders;

use Delivery\Infra\Models\Item;
use Illuminate\Database\Seeder;

final class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::factory()->count(20)->create();
    }
}
