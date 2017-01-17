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
    public function create($value)
    {
        $ratio = new Ratio($value[0], $value[1]);

        return $ratio;
    }

    /**
     * @return array
     */
    public function getMembersFields()
    {
        return array(
            'display_aspect_ratio',
            'original_display_aspect_ratio',
        );
    }
}
