<?php

namespace pxgamer\DecryptET;

/**
 * Class Implementations
 * @package pxgamer\DecryptET
 */
class Implementations
{
    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->$name = $value;
    }
}