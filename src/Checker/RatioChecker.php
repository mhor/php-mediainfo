<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\Ratio;

class RatioChecker extends AbstractAttributeChecker
{
    /**
     * @param array $value
     *
     * @return Ratio
     */
    public function create($value): \Mhor\MediaInfo\Attribute\Ratio
    {
        return new Ratio($value[0], $value[1]);
    }

    /**
     * @return array
     */
    public function getMembersFields(): array
    {
        return [
            'display_aspect_ratio',
            'original_display_aspect_ratio',
        ];
    }
}
