<?php

namespace Mhor\MediaInfo\Runner;

use Symfony\Component\Process\Process;

class MediaInfoCommandRunner
{
    public const MEDIAINFO_COMMAND = 'mediainfo';
    public const MEDIAINFO_OLDXML_OUTPUT_ARGUMENT = '--OUTPUT=OLDXML';
    public const MEDIAINFO_XML_OUTPUT_ARGUMENT = '--OUTPUT=XML';
    public const MEDIAINFO_FULL_DISPLAY_ARGUMENT = '-f';
    public const MEDIAINFO_URLENCODE = '--urlencode';
    public const MEDIAINFO_INCLUDE_COVER_DATA = '--Cover_Data=base64';

    /**
     * @var Process
     */
    protected $process;

    /**
     * @param Process $process
     */
    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    /**
     * @throws \RuntimeException
     *
     * @return string
     */
    public function run(): string
    {
        $this->process->run();
        if (!$this->process->isSuccessful()) {
            throw new \RuntimeException($this->process->getErrorOutput());
        }

        return $this->process->getOutput();
    }

    /**
     * Asynchronously start mediainfo operation.
     * Make call to MediaInfoCommandRunner::wait() afterwards to receive output.
     */
    public function start(): void
    {
        // just takes advantage of symfony's underlying Process framework
        // process runs in background
        $this->process->start();
    }

    /**
     * Blocks until call is complete.
     *
     * @throws \Exception        If this function is called before start()
     * @throws \RuntimeException
     *
     * @return string
     */
    public function wait(): string
    {
        // blocks here until process completes
        $this->process->wait();

        if (!$this->process->isSuccessful()) {
            throw new \RuntimeException($this->process->getErrorOutput());
        }

        return $this->process->getOutput();
    }
}
