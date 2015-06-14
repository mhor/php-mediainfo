<?php

namespace Mhor\MediaInfo\Runner;

use Symfony\Component\Process\ProcessBuilder;

class MediaInfoCommandRunner
{
    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var ProcessBuilder
     */
    protected $processBuilder;

    /**
     * @var Process
     */
    protected $processAsync = null;

    /**
     * @var string
     */
    protected $command = 'mediainfo';

    /**
     * @var array
     */
    protected $arguments = array('--OUTPUT=XML', '-f');

    /**
     * @param string         $filePath
     * @param array          $arguments
     * @param ProcessBuilder $processBuilder
     */
    public function __construct($filePath, array $arguments = null, $processBuilder = null)
    {
        $this->filePath = $filePath;

        if ($arguments !== null) {
            $this->arguments = $arguments;
        }

        if ($processBuilder === null) {
            $prefix = $this->arguments;
            array_unshift($prefix, $this->command);
            $this->processBuilder = ProcessBuilder::create()
                ->setPrefix(
                    $prefix
                );
        } else {
            $this->processBuilder = $processBuilder;
        }
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    public function run()
    {
        $this->processBuilder->add($this->filePath);
        $process = $this->processBuilder->getProcess();
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return $process->getOutput();
    }

    /**
     * Asynchronously start mediainfo operation.
     * Make call to MediaInfoCommandRunner::wait() afterwards to receive output.
     */
    public function start()
    {
        $this->processBuilder->add($this->filePath);
        $process = $this->processBuilder->getProcess();
        // just takes advantage of symfony's underlying Process framework
        // process runs in background
        $processAsync = $process->start();
    }

    /**
     * Blocks until call is complete.
     * @return string
     * @throws \Exception If this function is called before start()
     * @throws \RuntimeException
     */
    public function wait()
    {
        if ($processAsync == null) {
            throw new \Exception('You must run `start` before running `wait`');
        }

        // blocks here until process completes
        $processAsync->wait();
        
        if (!$processAsync->isSuccessful()) {
            throw new \RuntimeException($processAsync->getErrorOutput());
        }

        return $processAsync->getOutput();
    }
}
