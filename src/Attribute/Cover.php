<?php

namespace Mhor\MediaInfo\Attribute;

use Mhor\MediaInfo\DumpTrait;

class Cover implements AttributeInterface
{
    use DumpTrait;
    
    protected string $binaryCover;

    public function __construct(string $cover)
    {
        $this->binaryCover = $cover;
    }

    public function getBinaryCover(): string
    {
        return $this->binaryCover;
    }

    public function __toString(): string
    {
        return $this->binaryCover;
    }
}
