<?php

namespace Mhor\MediaInfo\Attribute;

class Cover
{
    /**
     * @var string
     */
    private $binaryCover;

    public function __construct($value)
    {
        $this->binaryCover = $value;
    }

    /**
     * @return string
     */
    public function getBinaryCover()
    {
        return $this->binaryCover;
    }
} 