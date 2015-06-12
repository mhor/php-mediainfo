<?php

namespace Mhor\MediaInfo;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;

class MediaInfo
{
    /**
     * @param $filePath
     * @throws UnknownTrackTypeException
     * @return MediaInfoContainer
     */
    public function getInfo($filePath, $ignoreUnknownTrackTypes = false)
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $output = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner($filePath)->run();

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->parse($output);

        return $mediaInfoOutputParser->getMediaInfoContainer($ignoreUnknownTrackTypes);
    }
}
