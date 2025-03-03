<?php

namespace LaraZeus\SEO\Tests;

use LaraZeus\SEO\SEOServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SEOServiceProvider::class,
        ];
    }
}
