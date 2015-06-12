<?php

namespace Mhor\MediaInfo;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;

class MediaInfo
{
    /**
     * @param $filePath
     * @param bool $ignoreUnknownTrackTypes Optional parameter used to skip unknown track types by passing true. The
                                            default behavior (false) is throw an exception on unknown track types.
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
