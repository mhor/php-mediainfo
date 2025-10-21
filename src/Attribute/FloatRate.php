<?php

namespace Mhor\MediaInfo\Attribute;

class FloatRate extends Rate
{
    public function getFloatAbsoluteValue(): float
    {
        return $this->absoluteValue;
    }
}
