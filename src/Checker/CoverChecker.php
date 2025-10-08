<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\Cover;

class CoverChecker extends AbstractAttributeChecker
{
    public function create($value): \Mhor\MediaInfo\Attribute\Cover
    {
        return new Cover($value);
    }

    public function getMembersFields(): array
    {
        return ['cover_data'];
    }
}
