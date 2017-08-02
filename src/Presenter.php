<?php

namespace Orbas\Util;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
    /**
     * @var Model
     */
    private $entity;

    /**
     * Presenter constructor.
     *
     * @param Model $entity
     */
    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    /**
     * get entity. 
     * 
     * @param string $name
     *
     * @return mixed
     */
    protected function attribute($name)
    {
        return $this->entity->getAttribute($name);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return $this->$name();
        }
        
        if ($this->attribute($name) !== null) {
            return $this->__($name);
        }
    }

    /**
     * translate model enum name.
     *
     * @param string $name
     *
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    public function __($name)
    {
        $value = app('enum')->value($this->attribute($name), $name);
        $key = ['enums', $name, $value];
        
        return __(implode('.', $key));
    }
}