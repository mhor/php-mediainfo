<?php

namespace Mhor\MediaInfo\Attribute;

class Cover extends AbstractAttribute
{
    /**
     * @var string
     */
    private $binaryCover;

    /**
     * @param string $value
     */
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
