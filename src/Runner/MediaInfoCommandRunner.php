<?php

namespace Mhor\MediaInfo\Runner;

use Symfony\Component\Process\Process;

class MediaInfoCommandRunner
{
    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var Process
     */
    protected $process;

    /**
     * @var string
     */
    protected $command = 'mediainfo';

    /**
     * @var array
     */
    protected $arguments = ['--OUTPUT=XML', '-f'];

    /**
     * @param string  $filePath
     * @param array   $arguments
     * @param Process $process
     */
    public function __construct(
        $filePath,
        $command = null,
        array $arguments = null,
        Process $process = null
    ) {
        $this->filePath = $filePath;
        if ($command !== null) {
            $this->command = $command;
        }

        if ($arguments !== null) {
            $this->arguments = $arguments;
        }

        $args = $this->arguments;
        array_unshift($args, $this->filePath);

        $env = [
            'LANG' => setlocale(LC_CTYPE, 0),
        ];
        $finalCommand = [$this->command];

        foreach ($args as $value) {
            $finalCommand[] = $value;
        }

        if (null !== $process) {
            $process->setEnv($env);
            $this->process = $process;
        } else {
            $this->process = new Process($finalCommand, null, $env);
        }
    }

    /**
     * @throws \RuntimeException
     *
     * @return string
     */
    public function run()
    {
        $this->process->run();
        //var_dump($this->process->getOutput());
        //exit();
        if (!$this->process->isSuccessful()) {
            throw new \RuntimeException($this->process->getErrorOutput());
        }

        return $this->process->getOutput();
    }

    /**
     * Asynchronously start mediainfo operation.
     * Make call to MediaInfoCommandRunner::wait() afterwards to receive output.
     */
    public function start()
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
    public function wait()
    {
        if ($this->process == null) {
            throw new \Exception('You must run `start` before running `wait`');
        }

        // blocks here until process completes
        $this->process->wait();

        if (!$this->process->isSuccessful()) {
            throw new \RuntimeException($this->process->getErrorOutput());
        }

        return $this->process->getOutput();
    }
}
