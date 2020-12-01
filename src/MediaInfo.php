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
    ];

    /**
     * @param $filePath
     * @param bool $ignoreUnknownTrackTypes Optional parameter used to skip unknown track types by passing true. The
     *                                      default behavior (false) is throw an exception on unknown track types.
     *
     * @throws \Mhor\MediaInfo\Exception\UnknownTrackTypeException
     *
     * @return MediaInfoContainer
     */
    public function getInfo($filePath, $ignoreUnknownTrackTypes = false): MediaInfoContainer
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $output = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner($filePath, $this->configuration)->run();

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->parse($output);

        return $mediaInfoOutputParser->getMediaInfoContainer($ignoreUnknownTrackTypes);
    }

    /**
     * Call to start asynchronous process.
     *
     * Make call to MediaInfo::getInfoWaitAsync() afterwards to received MediaInfoContainer object.
     *
     * @param $filePath
     */
    public function getInfoStartAsync($filePath): void
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
     *
     * @throws \Exception                                          If this function is called before getInfoStartAsync()
     * @throws \Mhor\MediaInfo\Exception\UnknownTrackTypeException
     *
     * @return MediaInfoContainer
     */
    public function getInfoWaitAsync($ignoreUnknownTrackTypes = false): MediaInfoContainer
    {
        if ($this->mediaInfoCommandRunnerAsync == null) {
            throw new \Exception('You must run `getInfoStartAsync` before running `getInfoWaitAsync`');
        }

        // blocks here until process is complete
        $output = $this->mediaInfoCommandRunnerAsync->wait();

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->parse($output);

        return $mediaInfoOutputParser->getMediaInfoContainer($ignoreUnknownTrackTypes);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @throws \Exception
     */
    public function setConfig($key, $value)
    {
        if (!array_key_exists($key, $this->configuration)) {
            throw new \Exception(
                sprintf('key "%s" does\'t exist', $key)
            );
        }

        $this->configuration[$key] = $value;
    }

    /**
     * @param $key
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function getConfig($key)
    {
        if (!array_key_exists($key, $this->configuration)) {
            throw new \Exception(
                sprintf('key "%s" does\'t exist', $key)
            );
        }

        return $this->configuration[$key];
    }
}
