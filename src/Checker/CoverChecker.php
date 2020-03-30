<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\Cover;

class CoverChecker extends AbstractAttributeChecker
{
    /**
     * @param string $value
     *
     * @return Cover
     */
    public function create($value): \Mhor\MediaInfo\Attribute\Cover
    {
        return new Cover($value);
    }

    /**
     * @return array
     */
    public function getMembersFields(): array
    {
        return ['cover_data'];
    }
}
