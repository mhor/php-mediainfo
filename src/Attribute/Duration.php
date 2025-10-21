<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Duration implements AttributeInterface
{
    use DumpTrait;

    protected int $milliseconds;

    public function __construct($duration)
    {
        $this->milliseconds = (int) $duration;
    }

    public function getMilliseconds(): int
    {
        return $this->milliseconds;
    }

    public function __toString(): string
    {
        return (string) $this->milliseconds;
    }
}
