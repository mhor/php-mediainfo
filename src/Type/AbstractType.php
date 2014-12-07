<?php

namespace Mhor\MediaInfo\Type;

abstract class AbstractType
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * @param $attribute
     * @return string
     */
    public function get($attribute)
    {
        $this->attributes[$attribute];
    }

    /**
     * @param $attribute
     * @param $value
     */
    public function set($attribute, $value)
    {
        return $this->attributes[$attribute] = $value;
    }
} 