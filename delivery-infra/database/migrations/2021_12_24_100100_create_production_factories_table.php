<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionFactoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_factories', function (Blueprint $table) {
            $table->string('hub_id', 30)->comment('拠点ID');
            $table->integer('capacity')->comment('生産能力');

            $table->primary('hub_id');
            $table->foreign('hub_id', 'production_factories-hubs')->references('hub_id')->on('hubs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_factories');
    }
}
