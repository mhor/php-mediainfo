<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Type\MediaInfoContainer;

interface OutputParserInterface
{
    /**
     * @param $output
     */
    public function parse($output);

    /**
     * @param array $output
     * @return MediaInfoContainer
     */
    public function getMediaInfoContainer(array $output);
}