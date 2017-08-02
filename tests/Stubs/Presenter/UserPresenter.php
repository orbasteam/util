<?php

namespace Tests\Stubs\Presenter;

use Orbas\Util\Presenter;

class UserPresenter extends Presenter
{
    public function fullName()
    {
        return $this->attribute('firstName').' '.$this->attribute('lastName');
    }

}