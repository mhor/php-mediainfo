<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Builder\MediaInfoContainerBuilder;
use Mhor\MediaInfo\Type\MediaInfoContainer;

class MediaInfoOutputParser extends AbstractXmlOutputParser
{

    /**
     * @param $output
     * @return MediaInfoContainer
     */
    public function parse($output)
    {
        return $this->getMediaInfoContainer($this->transformXmlToArray($output));
    }

    /**
     * @param array $output
     * @return MediaInfoContainer
     */
    public function getMediaInfoContainer(array $output)
    {
        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();
        $mediaInfoContainerBuilder->setVersion($output['@attributes']['version']);

        foreach ($output['File']['track'] as $trackType) {
            $mediaInfoContainerBuilder->addTrackType($trackType['@attributes']['type'], $trackType);
        }

        return $mediaInfoContainerBuilder->build();
    }
} 