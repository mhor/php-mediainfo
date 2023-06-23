<?php

namespace Mhor\MediaInfo\Tests\Stub\Attribute;

use Mhor\MediaInfo\Attribute\Duration;

class CustomDuration extends Duration
{
    public function getSeconds()
    {
        return $this->getMilliseconds() / 1000;
    }
}