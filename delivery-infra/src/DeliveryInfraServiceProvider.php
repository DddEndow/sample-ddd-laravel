<?php

declare(strict_types=1);

namespace Delivery\Infra;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class DeliveryInfraServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Delivery\\Infra\\Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
