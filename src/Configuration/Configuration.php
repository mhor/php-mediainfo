<?php

namespace Mhor\MediaInfo\Configuration;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;

class Configuration
{
    /**
     * @var string|null
     */
    protected $command = 'mediainfo';

    /**
     * @deprecated will be removed on 6.0
     * @var bool
     */
    protected $useOldXmlMediainfoOutputFormat = true;

    /**
     * @var bool
     */
    protected $urlencode = false;

    /**
     * @var bool
     */
    protected $includeCoverData = false;

    /**
     * @var bool
     */
    protected $ignoreUnknownTrackTypes = false;

    /**
     * @var null|array
     */
    protected $attributeCheckers = null;

    /**
     * @var null|MediaInfoCommandBuilder
     */
    protected $mediaInfoCommandBuilder = null;

    /**
     * @var null|MediaInfoOutputParser
     */
    protected $mediaInfoOutputParser = null;

    /**
     * @return string|null
     */
    public function getCommand(): ?string
    {
        return $this->command;
    }

    /**
     * @param string|null $command
     * @return Configuration
     */
    public function setCommand(?string $command): Configuration
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUseOldXmlMediainfoOutputFormat(): bool
    {
        return $this->useOldXmlMediainfoOutputFormat;
    }

    /**
     * @param bool $useOldXmlMediainfoOutputFormat
     * @return Configuration
     */
    public function setUseOldXmlMediainfoOutputFormat(bool $useOldXmlMediainfoOutputFormat): Configuration
    {
        $this->useOldXmlMediainfoOutputFormat = $useOldXmlMediainfoOutputFormat;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUrlencode(): bool
    {
        return $this->urlencode;
    }

    /**
     * @param bool $urlencode
     * @return Configuration
     */
    public function setUrlencode(bool $urlencode): Configuration
    {
        $this->urlencode = $urlencode;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIncludeCoverData(): bool
    {
        return $this->includeCoverData;
    }

    /**
     * @param bool $includeCoverData
     * @return Configuration
     */
    public function setIncludeCoverData(bool $includeCoverData): Configuration
    {
        $this->includeCoverData = $includeCoverData;
        return $this;
    }

    /**
     * @return bool
     */
    public function isIgnoreUnknownTrackTypes(): bool
    {
        return $this->ignoreUnknownTrackTypes;
    }

    /**
     * @param bool $ignoreUnknownTrackTypes
     * @return Configuration
     */
    public function setIgnoreUnknownTrackTypes(bool $ignoreUnknownTrackTypes): Configuration
    {
        $this->ignoreUnknownTrackTypes = $ignoreUnknownTrackTypes;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getAttributeCheckers(): ?array
    {
        return $this->attributeCheckers;
    }

    /**
     * @param array|null $attributeCheckers
     * @return Configuration
     */
    public function setAttributeCheckers(?array $attributeCheckers): Configuration
    {
        $this->attributeCheckers = $attributeCheckers;
        return $this;
    }

    /**
     * @return MediaInfoCommandBuilder|null
     */
    public function getMediaInfoCommandBuilder(): ?MediaInfoCommandBuilder
    {
        return $this->mediaInfoCommandBuilder;
    }

    /**
     * @param MediaInfoCommandBuilder|null $mediaInfoCommandBuilder
     * @return Configuration
     */
    public function setMediaInfoCommandBuilder(?MediaInfoCommandBuilder $mediaInfoCommandBuilder): Configuration
    {
        $this->mediaInfoCommandBuilder = $mediaInfoCommandBuilder;
        return $this;
    }

    /**
     * @return MediaInfoOutputParser|null
     */
    public function getMediaInfoOutputParser(): ?MediaInfoOutputParser
    {
        return $this->mediaInfoOutputParser;
    }

    /**
     * @param MediaInfoOutputParser|null $mediaInfoOutputParser
     * @return Configuration
     */
    public function setMediaInfoOutputParser(?MediaInfoOutputParser $mediaInfoOutputParser): Configuration
    {
        $this->mediaInfoOutputParser = $mediaInfoOutputParser;
        return $this;
    }
}