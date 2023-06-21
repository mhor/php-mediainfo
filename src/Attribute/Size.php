<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Size implements AttributeInterface
{
    use DumpTrait;

    /**
     * @var int
     */
    protected $bit;

    /**
     * @param string|int $size
     */
    public function __construct($size)
    {
        $this->bit = (int) $size;
    }

    /**
     * @return int
     */
    public function getBit(): int
    {
        return $this->bit;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->bit;
    }
}
