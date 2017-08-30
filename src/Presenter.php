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
     * @param string $column
     * @param string $enumName
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    public function __($column, $enumName = null, $locale = null)
    {
        $enumName = $enumName ?: $column;
        
        $value = app('enum')->value($this->attribute($column), $enumName);
        $key = implode('.', ['enums', $column, $value]);

        if (app('translator')->has($key)) {
            return app('translator')->trans($key, [], $locale);
        }

        return $value;
    }

    /**
     * @param string $column
     * @param string $enumName
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    public function enum($column, $enumName = null, $locale = null)
    {
        return $this->__($column, $enumName, $locale);
    }
}
