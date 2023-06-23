<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Builder\MediaInfoContainerBuilder;
use Mhor\MediaInfo\Configuration\Configuration;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Exception\MediainfoOutputParsingException;
use Mhor\MediaInfo\Exception\UnknownTrackTypeException;

class MediaInfoOutputParser extends AbstractXmlOutputParser
{
    /**
     * @var array
     */
    private $parsedOutput;

    /**
     * @param string $output
     */
    public function parse(string $output): array
    {
        return $this->transformXmlToArray($output);
    }

    /**
     * @param Configuration $configuration
     * @param array|null $parsedOutput
     *
     * @return MediaInfoContainer
     *
     * @throws MediainfoOutputParsingException
     * @throws UnknownTrackTypeException
     */
    public function getMediaInfoContainer(
        Configuration $configuration,
        array $parsedOutput = null
    ): \Mhor\MediaInfo\Container\MediaInfoContainer
    {
        if ($parsedOutput === null) {
            throw new \Exception('You must run `parse` before running `getMediaInfoContainer`');
        }

        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder($configuration->getAttributeCheckers());
        $mediaInfoContainerBuilder->setVersion($parsedOutput['@attributes']['version']);

        if (!array_key_exists('File', $parsedOutput)) {
            throw new MediainfoOutputParsingException(
                'XML format of mediainfo >=17.10 command has changed, check php-mediainfo documentation'
            );
        }

        foreach ($parsedOutput['File']['track'] as $trackType) {
            try {
                if (isset($trackType['@attributes']['type'])) {
                    $mediaInfoContainerBuilder->addTrackType($trackType['@attributes']['type'], $trackType);
                }
            } catch (UnknownTrackTypeException $ex) {
                if (!$configuration->isIgnoreUnknownTrackTypes()) {
                    // rethrow exception
                    throw $ex;
                }
                // else ignore
            }
        }

        return $mediaInfoContainerBuilder->build();
    }
}
