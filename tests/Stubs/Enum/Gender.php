<?php
namespace Tests\Stubs\Enum;

use Orbas\Util\Enum\Enumable;

class Gender implements Enumable
{
    /**
     * @return array
     */
    public function create()
    {
        return ['female', 'male'];
    }

}