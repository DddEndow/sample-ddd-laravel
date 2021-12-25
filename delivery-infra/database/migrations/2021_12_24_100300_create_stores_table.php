<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->string('hub_id', 30)->comment('拠点ID');
            $table->string('basic_information', 50)->comment('店舗基本情報');
            $table->string('route_code', 30)->nullable()->comment('配送ルートコード');
            $table->integer('delivery_order')->nullable()->comment('配送順序');

            $table->primary('hub_id');
            $table->unique(['route_code', 'delivery_order']);
            $table->foreign('hub_id', 'stores-hubs')->references('hub_id')->on('hubs');
            $table->foreign('route_code', 'stores-delivery_routes')->references('route_code')->on('delivery_routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
