<?php

namespace Mhor\MediaInfo;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;

class MediaInfo
{
    public function getInfo($filePath)
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $output = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner($filePath)->run();

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->parse($output);

        return $mediaInfoOutputParser->getMediaInfoContainer();
    }
}
