<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Mode implements AttributeInterface
{
    use DumpTrait;

    protected string $shortName;

    protected string $fullName;

    public function __construct(string $shortName, string $fullName)
    {
        $this->shortName = $shortName;
        $this->fullName = $fullName;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function __toString(): string
    {
        return $this->shortName;
    }
}
