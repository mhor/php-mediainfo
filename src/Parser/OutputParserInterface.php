<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Container\MediaInfoContainer;

interface OutputParserInterface
{
    /**
     * @param string $output
     */
    public function parse(string $output);

    /**
     * @return MediaInfoContainer
     */
    public function getMediaInfoContainer(): \Mhor\MediaInfo\Container\MediaInfoContainer;
}
