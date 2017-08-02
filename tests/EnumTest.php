<?php

namespace Tests;

use Illuminate\Support\Collection;
use Orbas\Util\Enum;

class EnumTest extends UtilTestCase
{
    protected function enum()
    {
        return new Enum('Tests\\Stubs\\Enum');
    }

    /**
     * @test
     * @group Enum
     */
    public function it_should_create_enum()
    {
        $collection = $this->enum()->create('gender');
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertSame(['female', 'male'], $collection->toArray());
    }

    /**
     * @test
     * @group Enum
     */
    public function it_should_get_value()
    {
        $this->assertEquals('male', $this->enum()->value(1, 'gender'));
    }
}
