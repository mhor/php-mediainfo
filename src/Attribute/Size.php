<?php

namespace Mhor\MediaInfo\Attribute;

class Size extends AbstractAttribute
{
    /**
     * @var int
     */
    protected $bit;

    /**
     * @param array $sizes
     */
    public function __construct(array $sizes)
    {
        $this->bit = $sizes[0];
    }

    /**
     * @return int
     */
    public function getBit()
    {
        return $this->bit;
    }
} 