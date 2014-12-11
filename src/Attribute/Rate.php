<?php

namespace Mhor\MediaInfo\Attribute;

class Rate extends AbstractAttribute
{
    /**
     * @var int
     */
    private $absoluteValue;

    /**
     * @var string
     */
    private $textValue;

    /**
     * @param array $value
     */
    public function __construct(array $value)
    {
        $this->absoluteValue = $value[0];
        $this->textValue = $value[1];
    }
}
