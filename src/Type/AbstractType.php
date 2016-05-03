<?php

namespace Mhor\MediaInfo\Type;

use Mhor\MediaInfo\DumpTrait;

abstract class AbstractType implements \JsonSerializable
{
    use DumpTrait;
    
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
