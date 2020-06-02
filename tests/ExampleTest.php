<?php

namespace Diskominfotik\Downloadable\Tests;

use Orchestra\Testbench\TestCase;
use Diskominfotik\Downloadable\DownloadableServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [DownloadableServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
