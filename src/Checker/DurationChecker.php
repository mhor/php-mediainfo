<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\Duration;

class DurationChecker extends AbstractAttributeChecker
{
    public function create($durations): \Mhor\MediaInfo\Attribute\Duration
    {
        return new Duration($durations[0]);
    }

    public function getMembersFields(): array
    {
        return [
            'duration',
            'delay_relative_to_video',
            'video0_delay',
            'delay',
        ];
    }
}
