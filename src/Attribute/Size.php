<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Size implements AttributeInterface
{
    use DumpTrait;

    protected int $bit;

    /**
     * @param string|int $size
     */
    public function __construct($size)
    {
        $this->bit = (int) $size;
    }

    public function getBit(): int
    {
        return $this->bit;
    }

    public function __toString(): string
    {
        return (string) $this->bit;
    }
}
