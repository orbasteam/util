<?php

namespace Tests;

use Illuminate\Translation\Translator;
use Orbas\Util\Enum;
use Tests\Stubs\User;

class PresenterTest extends UtilTestCase
{
    /**
     * @var User
     */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = new User();
    }

    /**
     * @test
     * @group Presenter
     */
    public function it_should_present_full_name()
    {
        $this->assertEquals('ivan wu', $this->user->present('fullName'));
    }

    /**
     * @test
     * @group Presenter
     */
    public function it_should_translate_enum()
    {
        $enum = new Enum('Tests\\Stubs\\Enum');
        $this->app->instance('enum', $enum);

        $translator = $this->initMock(Translator::class, 'translator');
        $translator->shouldReceive('getFromJson')->once()->andReturn('男');

        $this->assertEquals('男', $this->user->present('gender'));
    }

}