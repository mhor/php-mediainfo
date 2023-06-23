<?php

namespace Mhor\MediaInfo;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Configuration\Configuration;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;
use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class MediaInfo
{
    /**
     * @var MediaInfoCommandRunner|null
     */
    private $mediaInfoCommandRunnerAsync = null;

    /**
     * @var Configuration|null
     */
    private $configuration = null;

    /**
     * @param Configuration|null $configuration
     */
    public function __construct(?Configuration $configuration = null)
    {
        $this->configuration = $configuration;
        if (null === $this->configuration) {
            $this->configuration = new Configuration();
        }
    }

    /**
     * @param string $filePath
     * @param bool   $ignoreUnknownTrackTypes   Optional parameter used to skip unknown track types by passing true. The
     *                                          default behavior (false) is throw an exception on unknown track types.
     *                                          This parameter is deprecated use self::setConfig('ignore_unknown_track_types', true)
     *
     * @throws \Mhor\MediaInfo\Exception\UnknownTrackTypeException
     *
     * @return MediaInfoContainer
     */
    public function getInfo(string $filePath, bool $ignoreUnknownTrackTypes = false): MediaInfoContainer
    {
        if (true === $ignoreUnknownTrackTypes) {
            $this->setConfig('ignore_unknown_track_types', true);
        }

        $mediaInfoCommandBuilder = $this->configuration->getMediaInfoCommandBuilder();
        if (null === $mediaInfoCommandBuilder) {
            $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        }

        $output = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner($filePath, $this->configuration)->run();

        $mediaInfoOutputParser = $this->configuration->getMediaInfoOutputParser();
        if (null === $mediaInfoOutputParser) {
            $mediaInfoOutputParser = new MediaInfoOutputParser();
        }

        $parsedOutput = $mediaInfoOutputParser->parse($output);

        return $mediaInfoOutputParser->getMediaInfoContainer($this->configuration, $parsedOutput);
    }

    /**
     * Call to start asynchronous process.
     *
     * Make call to MediaInfo::getInfoWaitAsync() afterwards to received MediaInfoContainer object.
     *
     * @param string $filePath
     */
    public function getInfoStartAsync(string $filePath): void
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $this->mediaInfoCommandRunnerAsync = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner(
            $filePath,
            $this->configuration
        );
        $this->mediaInfoCommandRunnerAsync->start();
    }

    /**
     * @param bool $ignoreUnknownTrackTypes Optional parameter used to skip unknown track types by passing true. The
     *                                      default behavior (false) is throw an exception on unknown track types.
     *                                      This parameter is deprecated use self::setConfig('ignore_unknown_track_types', true)
     *
     * @throws \Exception                   If this function is called before getInfoStartAsync()
     * @throws \Mhor\MediaInfo\Exception\UnknownTrackTypeException
     *
     * @return MediaInfoContainer
     */
    public function getInfoWaitAsync(bool $ignoreUnknownTrackTypes = false): MediaInfoContainer
    {
        if (true === $ignoreUnknownTrackTypes) {
            $this->setConfig('ignore_unknown_track_types', true);
        }

        if ($this->mediaInfoCommandRunnerAsync == null) {
            throw new \Exception('You must run `getInfoStartAsync` before running `getInfoWaitAsync`');
        }

        // blocks here until process is complete
        $output = $this->mediaInfoCommandRunnerAsync->wait();

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->parse($output);

        return $mediaInfoOutputParser->getMediaInfoContainer($this->configuration);
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @throws \Exception
     */
    public function setConfig(string $key, $value)
    {
        switch ($key) {
            case 'command':
                $this->configuration->setCommand($value);
                break;
            case 'use_oldxml_mediainfo_output_format':
                $this->configuration->setUseOldXmlMediainfoOutputFormat($value);
                break;
            case 'urlencode':
                $this->configuration->setUrlencode($value);
                break;
            case 'include_cover_data':
                $this->configuration->setIncludeCoverData($value);
                break;
            case 'ignore_unknown_track_types':
                $this->configuration->setIgnoreUnknownTrackTypes($value);
                break;
            case 'attribute_checkers':
                $this->configuration->setAttributeCheckers($value);
                break;
            default:
                throw new \Exception(
                    sprintf('key "%s" does\'t exist', $key)
                );
        }
    }

    /**
     * @param string $key
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function getConfig(string $key)
    {
        switch ($key) {
            case 'command':
                return $this->configuration->getCommand();
            case 'use_oldxml_mediainfo_output_format':
                return $this->configuration->isUseOldXmlMediainfoOutputFormat();
            case 'urlencode':
                return $this->configuration->isUrlencode();
            case 'include_cover_data':
                return $this->configuration->isIncludeCoverData();
            case 'ignore_unknown_track_types':
                return $this->configuration->isIgnoreUnknownTrackTypes();
            case 'attribute_checkers':
                return $this->configuration->getAttributeCheckers();
            default:
                throw new \Exception(
                    sprintf('key "%s" does\'t exist', $key)
                );
        }
    }
}
