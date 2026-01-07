<?php

namespace Mhor\MediaInfo\Tests\Parser;

use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use PHPUnit\Framework\TestCase;
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
        $process = $this->createMock(Process::class);

        $process->expects($this->once())
            ->method('run')
            ->willReturn(1);

        $process->expects($this->once())
            ->method('getOutput')
            ->willReturn(file_get_contents($this->outputPath));

        $process->expects($this->once())
            ->method('isSuccessful')
            ->willReturn(true);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner($process);

        $this->assertEquals(file_get_contents($this->outputPath), $mediaInfoCommandRunner->run());
    }

    public function testRunException()
    {
        $this->expectException(\RuntimeException::class);

        $process = $this->createMock(Process::class);
        $process->expects($this->once())
            ->method('run')
            ->willReturn(0);

        $process->expects($this->once())
            ->method('getErrorOutput')
            ->willReturn('Error');

        $process->expects($this->once())
            ->method('isSuccessful')
            ->willReturn(false);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner($process);

        $mediaInfoCommandRunner->run();
    }

    public function testRunAsync()
    {
        $process = $this->createMock(Process::class);
        $process->expects($this->once())
            ->method('start');

        $process->expects($this->once())
            ->method('wait')
            ->willReturn(0);

        $process->expects($this->once())
            ->method('getOutput')
            ->willReturn(file_get_contents($this->outputPath));

        $process->expects($this->once())
            ->method('isSuccessful')
            ->willReturn(true);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner($process);

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

    public function testRunAsyncFail()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Error');

        $process = $this->createMock(Process::class);
        $process->expects($this->once())
            ->method('start');

        $process->expects($this->once())
            ->method('wait')
            ->willReturn(1);

        $process->expects($this->once())
            ->method('getErrorOutput')
            ->willReturn('Error');

        $process->expects($this->once())
            ->method('isSuccessful')
            ->willReturn(false);


        $mediaInfoCommandRunner = new MediaInfoCommandRunner($process);

        $mediaInfoCommandRunner->start();

        // do some stuff in between, count to 5
        $i = 0;
        do {
            $i++;
        } while ($i < 5);

        // block and complete operation
        $mediaInfoCommandRunner->wait();
    }
}
