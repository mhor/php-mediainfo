<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Builder\MediaInfoContainerBuilder;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Exception\MediainfoOutputParsingException;
use Mhor\MediaInfo\Exception\UnknownTrackTypeException;

class MediaInfoOutputParser extends AbstractXmlOutputParser
{
    private ?array $parsedOutput = null;

    public function parse(string $output): void
    {
        $this->parsedOutput = $this->transformXmlToArray($output);
    }

    public function getMediaInfoContainer(array $configuration): \Mhor\MediaInfo\Container\MediaInfoContainer
    {
        if ($this->parsedOutput === null) {
            throw new \Exception('You must run `parse` before running `getMediaInfoContainer`');
        }

        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder($configuration['attribute_checkers']);
        $mediaInfoContainerBuilder->setVersion($this->parsedOutput['@attributes']['version']);

        if (!array_key_exists('File', $this->parsedOutput)) {
            throw new MediainfoOutputParsingException(
                'XML format of mediainfo >=17.10 command has changed, check php-mediainfo documentation'
            );
        }

        foreach ($this->parsedOutput['File']['track'] as $trackType) {
            try {
                if (isset($trackType['@attributes']['type'])) {
                    $mediaInfoContainerBuilder->addTrackType($trackType['@attributes']['type'], $trackType);
                }
            } catch (UnknownTrackTypeException $ex) {
                if (!$configuration['ignore_unknown_track_types']) {
                    // rethrow exception
                    throw $ex;
                }
                // else ignore
            }
        }

        return $mediaInfoContainerBuilder->build();
    }
}
