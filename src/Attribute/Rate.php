<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Rate implements AttributeInterface
{
    use DumpTrait;

    /**
     * @var int
     */
    private $absoluteValue;

    /**
     * @var string
     */
    private $textValue;

    /**
     * @param string|int $absoluteValue
     * @param string     $textValue
     */
    public function __construct($absoluteValue, string $textValue)
    {
        $this->absoluteValue = (int) $absoluteValue;
        $this->textValue = $textValue;
    }

    /**
     * @return int
     */
    public function getAbsoluteValue(): int
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
