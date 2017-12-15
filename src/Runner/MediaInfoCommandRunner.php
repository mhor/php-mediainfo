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

        array_unshift($this->arguments, $this->filePath);

        if (method_exists('Symfony\\Component\\Process\\ProcessUtils', 'escapeArgument')) {
            // Symfony 2 compatibility
            $input = implode(' ', array_map(['Symfony\\Component\\Process\\ProcessUtils', 'escapeArgument'], $this->arguments));
        } else {
            $input = new \ArrayIterator($this->arguments);
        }

        if (null !== $process) {
            $process->setCommandLine($this->command);
            $process->setInput($input);
            $this->process = $process;
        } else {
            $this->process = new Process(
                $this->command,
                null,
                null,
                $input
            );
        }
    }

    /**
     * @throws \RuntimeException
     *
     * @return string
     */
    public function run()
    {
        $env = [
            'LANG' => setlocale(LC_CTYPE, 0),
        ];
        $this->process->setEnv($env);
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
