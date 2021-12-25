<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id', 30)->comment('発注ID');
            $table->string('store_id', 30)->comment('店舗拠点ID');
            $table->dateTime('registration_order_datetime')->comment('発注登録日時');
            $table->dateTime('scheduled_delivery_datetime')->nullable()->comment('配送予定日時');

            $table->primary('order_id');
            $table->foreign('store_id', 'orders-stores')->references('hub_id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
