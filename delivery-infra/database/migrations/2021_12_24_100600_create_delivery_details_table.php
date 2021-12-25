<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->string('delivery_id', 30)->comment('配送ID');
            $table->string('item_id', 30)->comment('商品ID');
            $table->integer('quantity')->comment('発注数量');

            $table->primary(['delivery_id', 'item_id']);
            $table->foreign('item_id', 'delivery_details-items')->references('item_id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_details');
    }
}
