<?php

namespace Mhor\MediaInfo;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;
use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;

class MediaInfo
{
    /**
     * @var MediaInfoCommandRunner|null
     */
    private $mediaInfoCommandRunnerAsync = null;

    /**
     * @var array
     */
    private $configuration = [
        'command'                            => null,
        'use_oldxml_mediainfo_output_format' => true,
        'urlencode'                          => false,
        'include_cover_data'                 => false,
        'ignore_unknown_track_types'         => false,
        'attribute_checkers'                 => null,
    ];

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
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $output = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner($filePath, $this->configuration)->run();

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->parse($output);

        if (true === $ignoreUnknownTrackTypes) {
            $this->setConfig('ignore_unknown_track_types', true);
        }

        return $mediaInfoOutputParser->getMediaInfoContainer($this->configuration);
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
        if ($this->mediaInfoCommandRunnerAsync == null) {
            throw new \Exception('You must run `getInfoStartAsync` before running `getInfoWaitAsync`');
        }

        // blocks here until process is complete
        $output = $this->mediaInfoCommandRunnerAsync->wait();

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->parse($output);

        if (true === $ignoreUnknownTrackTypes) {
            $this->setConfig('ignore_unknown_track_types', true);
        }

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
        if (!array_key_exists($key, $this->configuration)) {
            throw new \Exception(
                sprintf('key "%s" does\'t exist', $key)
            );
        }

        $this->configuration[$key] = $value;
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
        if (!array_key_exists($key, $this->configuration)) {
            throw new \Exception(
                sprintf('key "%s" does\'t exist', $key)
            );
        }

        return $this->configuration[$key];
    }
}
