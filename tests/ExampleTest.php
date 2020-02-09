<?php

namespace Leeovery\MailcoachApi\Tests;

use Orchestra\Testbench\TestCase;
use Leeovery\MailcoachApi\MailcoachApiServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [MailcoachApiServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
