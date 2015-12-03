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
     *
     * @return string
     */
    public function set($attribute, $value)
    {
        if(!isset($this->attributes[$attribute]))
            $this->attributes[$attribute] = $value;
    }

    /**
     * @param string $attribute
     *
     * @return mixed
     */
    public function get($attribute = null)
    {
        if ($attribute === null) {
            return $this->attributes;
        }

        if (isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }

        return;
    }
}
