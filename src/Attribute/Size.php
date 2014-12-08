<?php

namespace Mhor\MediaInfo\Attribute;

class Size
{

    /**
     * @var int
     */
    protected $bit;

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