<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Builder\MediaInfoContainerBuilder;
use Mhor\MediaInfo\Parser\AbstractXmlOutputParser;

class MediaInfoOutputParser extends AbstractXmlOutputParser
{
    public function parse($output)
    {
        return $this->getMediaInfoContainer($this->transformXmlToArray($output));
    }

    public function getMediaInfoContainer(array $output)
    {
        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();
        $mediaInfoContainerBuilder->setVersion($output['@attributes']['version']);

        foreach($output['File']['track'] as $trackType) {
            $mediaInfoContainerBuilder->addTrackType($trackType['@attributes']['type'], $trackType);
        }

        return $mediaInfoContainerBuilder->build();
    }
} 