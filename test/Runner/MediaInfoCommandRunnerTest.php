<?php

namespace Mhor\MediaInfo\Test\Parser;

use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Process\Process;

class MediaInfoCommandRunnerTest extends TestCase
{
    /**
     * @var string
     */
    private $outputPath;

    /**
     * @var string
     */
    private $filePath;

    protected function setUp(): void
    {
        $this->filePath = __DIR__.'/../fixtures/test.mp3';
        $this->outputPath = __DIR__.'/../fixtures/mediainfo-output.xml';
    }

    public function testRun()
    {
        $process = $this->prophesize(Process::class);

        $process
            ->setCommandLine(Argument::type('string'))
            ->shouldBeCalled();

        $process
            ->setEnv(Argument::type('array'))
            ->shouldBeCalled();

        $process
            ->run()
            ->shouldBeCalled()
            ->willReturn(1);

        $process
            ->getOutput()
            ->shouldBeCalled()
            ->willReturn(file_get_contents($this->outputPath));

        $process
            ->isSuccessful()
            ->shouldBeCalled()
            ->willReturn(true);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner(
            $this->filePath,
            null,
            ['--OUTPUT=XML', '-f'],
            $process->reveal()
        );

        $this->assertEquals(file_get_contents($this->outputPath), $mediaInfoCommandRunner->run());
    }

    public function testRunException()
    {
        $this->expectException(\RuntimeException::class);

        $process = $this->prophesize(Process::class);

        $process
            ->setCommandLine(Argument::type('string'))
            ->shouldBeCalled();

        $process
            ->setEnv(Argument::type('array'))
            ->shouldBeCalled();

        $process
            ->run()
            ->shouldBeCalled()
            ->willReturn(0);

        $process
            ->getErrorOutput()
            ->shouldBeCalled()
            ->willReturn('Error');

        $process
            ->isSuccessful()
            ->shouldBeCalled()
            ->willReturn(false);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner(
            $this->filePath,
            'custom_mediainfo',
            ['--OUTPUT=XML', '-f'],
            $process->reveal()
        );

        $mediaInfoCommandRunner->run();
    }

    public function testRunAsync()
    {
        $process = $this->prophesize(Process::class);

        $process
            ->setCommandLine(Argument::type('string'))
            ->shouldBeCalled();

        $process
            ->setEnv(Argument::type('array'))
            ->shouldBeCalled();

        $process
            ->start()
            ->shouldBeCalled()
            ->willReturn($process);

        $process
            ->wait()
            ->shouldBeCalled()
            ->willReturn(true);

        $process
            ->getOutput()
            ->shouldBeCalled()
            ->willReturn(file_get_contents($this->outputPath));

        $process
            ->isSuccessful()
            ->shouldBeCalled()
            ->willReturn(true);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner(
            $this->filePath,
            null,
            ['--OUTPUT=XML', '-f'],
            $process->reveal()
        );

        $mediaInfoCommandRunner->start();

        // do some stuff in between, count to 5
        $i = 0;
        do {
            $i++;
        } while ($i < 5);

        // block and complete operation
        $output = $mediaInfoCommandRunner->wait();

        $this->assertEquals(file_get_contents($this->outputPath), $output);
    }
}
