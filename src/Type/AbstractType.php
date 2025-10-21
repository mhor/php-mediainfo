<?php

namespace Mhor\MediaInfo\Type;

use Mhor\MediaInfo\DumpTrait;

abstract class AbstractType implements \JsonSerializable
{
    use DumpTrait;

    protected array $attributes = [];

    /**
     * @param $attribute
     * @param string|object $value
     */
    public function set($attribute, $value): void
    {
        $this->attributes[$attribute] = $value;
    }

    public function get(?string $attribute = null)
    {
        if ($attribute === null) {
            return $this->attributes;
        }

        if ($this->has($attribute)) {
            return $this->attributes[$attribute];
        }

        return null;
    }

    public function has(string $attribute): bool
    {
        if (isset($this->attributes[$attribute])) {
            return true;
        }

        return false;
    }

    public function list(): array
    {
        return array_keys($this->attributes);
    }

    /**
     * Convert the object into json.
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
     */
    public function __toArray(): array
    {
        return $this->jsonSerialize();
    }
}
