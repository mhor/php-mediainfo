<?php

namespace Mhor\MediaInfo\Attribute;

class Size implements AttributeInterface
{
    /**
     * @var int
     */
    private $bit;

    /**
     * @param int $size
     *
     * @return Size
     */
    public function __construct($size)
    {
        $this->bit = $size;
    }

    /**
     * @return int
     */
    public function getBit()
    {
        return $this->bit;
    }
}
