<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\Mode;

class ModeChecker extends AbstractAttributeChecker
{

    /**
     * @param array $rateMode
     * @return Mode
     */
    public function create($rateMode)
    {
        $mode = new Mode($rateMode[0], $rateMode[1]);
        return $mode;
    }

    /**
     * @return array
     */
    public function getMembersFields()
    {
        return array(
            'overall_bit_rate_mode',
            'overall_bit_rate',
            'bit_rate_mode',
            'compression_mode',
            'codec',
            'format',
            'kind_of_stream',
            'writing_library',
        );
    }
}
