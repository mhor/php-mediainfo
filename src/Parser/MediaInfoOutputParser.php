<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Builder\MediaInfoContainerBuilder;
use Mhor\MediaInfo\Container\MediaInfoContainer;

class MediaInfoOutputParser extends AbstractXmlOutputParser
{
    /**
     * @var array
     */
    private $parsedOutput;

    /**
     * @param string $output
     */
    public function parse($output)
    {
        $this->parsedOutput = $this->transformXmlToArray($output);
    }

    /**
     * @throws \Exception
     * @return MediaInfoContainer
     */
    public function getMediaInfoContainer()
    {
        if ($this->parsedOutput === null) {
            throw new \Exception('You must run `parse` before running `getMediaInfoContainer`');
        }

        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();
        $mediaInfoContainerBuilder->setVersion($this->parsedOutput['@attributes']['version']);

        foreach ($this->parsedOutput['File']['track'] as $trackType) {
            $mediaInfoContainerBuilder->addTrackType($trackType['@attributes']['type'], $trackType);
        }

        return $mediaInfoContainerBuilder->build();
    }
}
