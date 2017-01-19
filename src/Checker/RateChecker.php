<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\Rate;

class RateChecker extends AbstractAttributeChecker
{
    /**
     * @param array $value
     *
     * @return Rate
     */
    public function create($value)
    {
        $rate = new Rate($value[0], $value[1]);

        return $rate;
    }

    /**
     * @return array
     */
    public function getMembersFields()
    {
        return [
            'maximum_bit_rate',
            'channel_s',
            'bit_rate',
            'sampling_rate',
            'bit_depth',
            'width',
            'nominal_bit_rate',
            'frame_rate',
            'format_settings_reframes',
            'height',
            'resolution',
        ];
    }
}
