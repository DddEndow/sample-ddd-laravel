<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_routes', function (Blueprint $table) {
            $table->string('route_code', 30)->comment('配送ルートコード');
            $table->string('name', 50)->comment('ルート名称');
            $table->string('production_factory_id', 30)->comment('生産工場拠点ID');

            $table->primary(['route_code', 'production_factory_id']);
            $table->foreign('production_factory_id', 'delivery_routes-production_factories')->references('hub_id')->on('production_factories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_routes');
    }
}
