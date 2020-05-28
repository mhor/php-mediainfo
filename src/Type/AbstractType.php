<?php

namespace Mhor\MediaInfo\Type;

use Mhor\MediaInfo\DumpTrait;

abstract class AbstractType implements \JsonSerializable
{
    use DumpTrait;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @param $attribute
     * @param string|object $value
     *
     * @return string
     */
    public function set($attribute, $value): void
    {
        $this->attributes[$attribute] = $value;
    }

    /**
     * @param string $attribute
     *
     * @return mixed
     */
    public function get(string $attribute = null)
    {
        if ($attribute === null) {
            return $this->attributes;
        }

        if ($this->has($attribute)) {
            return $this->attributes[$attribute];
        }

        return null;
    }

    /**
     * @param string $attribute
     *
     * @return bool
     */
    public function has(string $attribute): bool
    {
        if (isset($this->attributes[$attribute])) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function list(): array
    {
        return array_keys($this->attributes);
    }

    /**
     * Convert the object into json.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        $array = get_object_vars($this);

        if (isset($array['attributes'])) {
            $array = $array['attributes'];
        }

        return $array;
    }

    /**
     * Convert the object into array.
     *
     * @return array
     */
    public function __toArray(): array
    {
        return $this->jsonSerialize();
    }
}
