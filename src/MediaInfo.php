<?php

namespace Mhor\MediaInfo;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;

class MediaInfo
{
    public function getInformations($filePath)
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $output = $mediaInfoCommandBuilder->buildMediaCommandBuilder($filePath)->run();

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        return $mediaInfoOutputParser->parse($output);
    }
} 