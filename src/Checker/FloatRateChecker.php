<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\FloatRate;

class FloatRateChecker extends AbstractAttributeChecker
{
    public function create($value): FloatRate
    {
        return new FloatRate($value[0], $value[1]);
    }

    public function getMembersFields(): array
    {
        return [
            'frame_rate',
        ];
    }
}
