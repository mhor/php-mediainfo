<?php

namespace Mhor\MediaInfo\Tests\Stub\Checker;

use Mhor\MediaInfo\Tests\Stub\Attribute\CustomDuration;

class CustomDurationChecker extends \Mhor\MediaInfo\Checker\DurationChecker
{
    public function create($durations): \Mhor\MediaInfo\Attribute\Duration
    {
        return new CustomDuration($durations[0]);
    }

    public function getMembersFields(): array
    {
        return [
            'duration',
        ];
    }
}