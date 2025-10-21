<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Rate implements AttributeInterface
{
    use DumpTrait;

    protected float $absoluteValue;

    protected string $textValue;

    /**
     * @param string|int $absoluteValue
     */
    public function __construct($absoluteValue, string $textValue)
    {
        $this->absoluteValue = (float) $absoluteValue;
        $this->textValue = $textValue;
    }

    public function getAbsoluteValue(): int
    {
        return round($this->absoluteValue);
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
