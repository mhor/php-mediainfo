<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Duration implements AttributeInterface
{
    use DumpTrait;

    /**
     * @var int
     */
    private $milliseconds;

    /**
     * @param string|int $duration
     */
    public function __construct($duration)
    {
        $this->milliseconds = (int) $duration;
    }

    /**
     * @return int
     */
    public function getMilliseconds(): int
    {
        return $this->milliseconds;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->milliseconds;
    }
}
