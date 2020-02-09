<?php

namespace Mhor\MediaInfo\Test\Builder;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use PHPUnit\Framework\TestCase;

class MediaInfoCommandBuilderTest extends TestCase
{
    private $filePath;

    protected function setUp(): void
    {
        $this->filePath = __DIR__.'/../fixtures/test.mp3';
    }

    public function testBuilderCommandWithUrl()
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('https://example.org/');

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner('https://example.org/');
        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);

        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('http://example.org/');

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner('http://example.org/');
        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);
    }

    public function testExceptionWithNonExistingFile()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File "non existing path" does not exist');
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('non existing path');
    }

    public function testExceptionWithDirectory()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Expected a filename, got ".", which is a directory');
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('.');
    }

    public function testBuilderCommand()
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner($this->filePath);

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner($this->filePath);
        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);
    }

    public function testConfiguredCommand()
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner(
            $this->filePath,
            [
                'command'                            => '/usr/bin/local/mediainfo',
                'use_oldxml_mediainfo_output_format' => false,
            ]
        );

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner(
            $this->filePath,
            '/usr/bin/local/mediainfo',
            null,
            null,
            false
        );

        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);
    }
}
