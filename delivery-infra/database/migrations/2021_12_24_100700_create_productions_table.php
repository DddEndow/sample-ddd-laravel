<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->string('production_id', 30)->comment('生産ID');
            $table->string('production_factory_id', 30)->comment('生産工場拠点ID');
            $table->dateTime('scheduled_creation_datetime')->comment('生産予定日時');
            $table->dateTime('creation_completion_datetime')->nullable()->comment('生産完了日時');

            $table->primary('production_id');
            $table->foreign('production_factory_id', 'productions-production_factories')->references('hub_id')->on('production_factories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productions');
    }
}
