<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Mode implements AttributeInterface
{
    use DumpTrait;

    /**
     * @var string
     */
    private $shortName;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @param string $shortName
     * @param string $fullName
     */
    public function __construct(string $shortName, string $fullName)
    {
        $this->shortName = $shortName;
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->shortName;
    }
}
