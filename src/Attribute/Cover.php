<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Cover implements AttributeInterface
{
    use DumpTrait;
    /**
     * @var string
     */
    private $binaryCover;

    /**
     * @param string $cover
     */
    public function __construct(string $cover)
    {
        $this->binaryCover = $cover;
    }

    /**
     * @return string
     */
    public function getBinaryCover(): string
    {
        return $this->binaryCover;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->binaryCover;
    }
}
