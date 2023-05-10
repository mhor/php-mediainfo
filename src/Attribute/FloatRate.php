<?php

namespace Mhor\MediaInfo\Attribute;

class FloatRate extends Rate
{
    /**
     * @return float
     */
    public function getFloatAbsoluteValue(): float
    {
        return $this->absoluteValue;
    }
}
