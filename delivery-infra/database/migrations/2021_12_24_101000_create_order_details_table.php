<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->string('order_id', 30)->comment('発注ID');
            $table->string('item_id', 30)->comment('商品ID');
            $table->string('production_id', 30)->nullable()->comment('生産ID');
            $table->string('delivery_id', 30)->nullable()->comment('配送ID');
            $table->integer('quantity')->comment('発注数量');

            $table->primary(['order_id', 'item_id']);
            $table->unique(['order_id', 'item_id', 'production_id', 'delivery_id']);
            $table->foreign('item_id', 'order_details-items')->references('item_id')->on('items');
            $table->foreign('production_id', 'order_details-production_details')->references('production_id')->on('production_details');
            $table->foreign('delivery_id', 'order_details-delivery_details')->references('delivery_id')->on('delivery_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
