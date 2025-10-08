<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Ratio implements AttributeInterface
{
    use DumpTrait;

    protected float $absoluteValue;

    protected string $textValue;

    /**
     * @param string|float $absoluteValue
     */
    public function __construct($absoluteValue, string $textValue)
    {
        $this->absoluteValue = (float) $absoluteValue;
        $this->textValue = $textValue;
    }

    public function getAbsoluteValue(): float
    {
        return $this->absoluteValue;
    }

    public function getTextValue(): string
    {
        return $this->textValue;
    }

    public function __toString(): string
    {
        return $this->textValue;
    }
}
