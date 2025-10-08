<?php

namespace Mhor\MediaInfo\Attribute;

interface AttributeInterface extends \JsonSerializable
{
    public function __toString(): string;
}
