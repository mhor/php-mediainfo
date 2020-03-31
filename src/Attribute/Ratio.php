<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Ratio implements AttributeInterface
{
    use DumpTrait;

    /**
     * @var float
     */
    private $absoluteValue;

    /**
     * @var string
     */
    private $textValue;

    /**
     * @param string|float $absoluteValue
     * @param string       $textValue
     */
    public function __construct($absoluteValue, string $textValue)
    {
        $this->absoluteValue = (float) $absoluteValue;
        $this->textValue = $textValue;
    }

    /**
     * @return float
     */
    public function getAbsoluteValue(): float
    {
        return $this->absoluteValue;
    }

    /**
     * @return string
     */
    public function getTextValue(): string
    {
        return $this->textValue;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->textValue;
    }
}
