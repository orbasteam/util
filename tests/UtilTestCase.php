<?php

namespace Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Mockery;
use Orbas\Util\ServiceProvider;

class UtilTestCase extends AbstractPackageTestCase
{
    protected function getServiceProviderClass($app)
    {
        return ServiceProvider::class;
    }

    /**
     * @param string $class
     *
     * @return Mockery\MockInterface
     */
    public function initMock($class, $abstract = null)
    {
        if (!$abstract) {
            $abstract = $class;
        }

        $mock = Mockery::mock($class);
        $this->app->instance($abstract, $mock);

        return $mock;
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->tearDownMockery();
    }
}
