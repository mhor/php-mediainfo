<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\FloatRate;

class FloatRateChecker extends AbstractAttributeChecker
{
    /**
     * @param array $value
     *
     * @return FloatRate
     */
    public function create($value): FloatRate
    {
        return new FloatRate($value[0], $value[1]);
    }

    /**
     * @return array
     */
    public function getMembersFields(): array
    {
        return [
            'frame_rate',
        ];
    }
}
