<?php

namespace Mhor\MediaInfo\Checker;

use Mhor\MediaInfo\Attribute\Size;

class SizeChecker extends AbstractAttributeChecker
{
    /**
     * @param array $sizes
     *
     * @return Size
     */
    public function create($sizes): \Mhor\MediaInfo\Attribute\Size
    {
        return new Size($sizes[0]);
    }

    /**
     * @return array
     */
    public function getMembersFields(): array
    {
        return [
            'file_size',
            'stream_size',
        ];
    }
}
