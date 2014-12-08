<?php

namespace Mhor\MediaInfo\Type;

abstract class AbstractType
{
    /**
     * @var array
     */
    protected $attributes = array();

    /**
     * @param $attribute
     * @param string|object $value
     * @return string
     */
    public function set($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }

    /**
     * @param $attribute
     *
     * @return string|object|null
     */
    public function get($attribute)
    {
        if (isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }
        return null;
    }
} 