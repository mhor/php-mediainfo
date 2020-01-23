<?php

namespace Mhor\MediaInfo\Test\Parser;

use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use PHPUnit\Framework\TestCase;

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
        $processMock = $this->getMockBuilder('Symfony\Component\Process\Process')
            ->disableOriginalConstructor()
            ->getMock();

        $processMock->method('run')
            ->willReturn(1);

        $processMock->method('getOutput')
            ->willReturn(file_get_contents($this->outputPath));

        $processMock->method('isSuccessful')
            ->willReturn(true);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner(
            $this->filePath,
            null,
            ['--OUTPUT=XML', '-f'],
            $processMock
        );

        $this->assertEquals(file_get_contents($this->outputPath), $mediaInfoCommandRunner->run());
    }

    public function testRunException()
    {
        $this->expectException(\RuntimeException::class);
        $processMock = $this->getMockBuilder('Symfony\Component\Process\Process')
            ->disableOriginalConstructor()
            ->getMock();

        $processMock->method('run')
            ->willReturn(0);

        $processMock->method('getErrorOutput')
            ->willReturn('Error');

        $processMock->method('isSuccessful')
            ->willReturn(false);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner(
            $this->filePath,
            'custom_mediainfo',
            ['--OUTPUT=XML', '-f'],
            $processMock
        );

        $mediaInfoCommandRunner->run();
    }

    public function testRunAsync()
    {
        $processMock = $this->getMockBuilder('Symfony\Component\Process\Process')
            ->disableOriginalConstructor()
            ->getMock();

        $processMock->method('start')
            ->willReturn($processMock);

        $processMock->method('wait')
            ->willReturn(true);

        $processMock->method('getOutput')
            ->willReturn(file_get_contents($this->outputPath));

        $processMock->method('isSuccessful')
            ->willReturn(true);

        $mediaInfoCommandRunner = new MediaInfoCommandRunner(
            $this->filePath,
            null,
            ['--OUTPUT=XML', '-f'],
            $processMock
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
