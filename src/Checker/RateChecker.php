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
        return array(
            'channel_s_',
            'bit_rate',
            'sampling_rate',
        );
    }
}
