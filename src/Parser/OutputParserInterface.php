<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Configuration\Configuration;
use Mhor\MediaInfo\Container\MediaInfoContainer;

interface OutputParserInterface
{
    /**
     * @param string $output
     */
    public function parse(string $output);

    /**
     * @param Configuration $configuration
     * @return MediaInfoContainer
     */
    public function getMediaInfoContainer(Configuration $configuration): \Mhor\MediaInfo\Container\MediaInfoContainer;
}
