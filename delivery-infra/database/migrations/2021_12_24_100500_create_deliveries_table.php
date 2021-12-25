<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->string('delivery_id', 30)->comment('配送ID');
            $table->string('store_id', 30)->comment('店舗拠点ID');
            $table->dateTime('scheduled_delivery_datetime')->comment('配送予定日時');
            $table->dateTime('delivery_completion_datetime')->nullable()->comment('配送完了日時');

            $table->primary('delivery_id');
            $table->foreign('store_id', 'deliveries-stores')->references('hub_id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
