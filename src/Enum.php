<?php

namespace Orbas\Util;

use Illuminate\Support\Collection;
use Orbas\Util\Enum\Enumable;

class Enum
{
    /**
     * @var array
     */
    protected $enums = [];

    /**
     * @var string
     */
    private $namespace;

    /**
     * Enum constructor.
     *
     * @param string $namespace
     */
    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @param $name
     *
     * @return Collection
     */
    public function create($name)
    {
        return collect($this->retrieveClass($name)->create());
    }

    /**
     * @param string $key
     * @param mixed  $name
     *
     * @return mixed
     */
    public function value($key, $name)
    {
        return $this->create($name)->get($key);
    }

    /**
     * @param $name
     *
     * @return Enumable
     */
    protected function retrieveClass($name)
    {
        if (!$this->enumExists($name)) {
            $this->enums[$name] = $this->buildClass($name);
        }

        return $this->enums[$name];
    }

    /**
     * determine if enum class exists.
     *
     * @param string $className
     *
     * @return bool
     */
    protected function enumExists($className)
    {
        return isset($this->enums[$className]);
    }

    /**
     * Build a Enum class.
     *
     * @param string $name
     *
     * @throws RuntimeException
     *
     * @return Enumable
     */
    protected function buildClass($name)
    {
        $className = $this->formatClassName($name);

        if (!class_exists($className)) {
            throw new RuntimeException('Enum '.$className.' is not exists');
        }

        $enum = new $className();
        if (!$enum instanceof Enumable) {
            throw new RuntimeException('Enum '.$className.' is not instance of '.Enumable::class);
        }

        return $enum;
    }

    protected function formatClassName($name)
    {
        return $this->namespace.'\\'.studly_case($name);
    }
}