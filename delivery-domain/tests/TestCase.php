<?php

declare(strict_types=1);

namespace Delivery\Domain\Tests;

use \Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            //
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
