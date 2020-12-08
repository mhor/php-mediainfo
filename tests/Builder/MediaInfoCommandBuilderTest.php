<?php

namespace Mhor\MediaInfo\Tests\Builder;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class MediaInfoCommandBuilderTest extends TestCase
{
    private $filePath;

    protected function setUp(): void
    {
        $this->filePath = __DIR__.'/../fixtures/test.mp3';
    }

    public function testBuilderCommandWithHttpsUrl(): void
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('https://example.org/');

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner(new Process(
            [
                'mediainfo',
                'https://example.org/',
                '-f',
                '--OUTPUT=OLDXML',
            ],
            null,
            [
                'MEDIAINFO_VAR_FILE_PATH'    => 'https://example.org/',
                'MEDIAINFO_VAR_FULL_DISPLAY' => '-f',
                'MEDIAINFO_VAR_OUTPUT'       => '--OUTPUT=OLDXML',
                'LANG'                       => 'en_US.UTF-8',
            ]
        ));

        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);
    }

    public function testBuilderCommandWithHttpUrl(): void
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('http://example.org/');

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner(new Process(
            [
                'mediainfo',
                'http://example.org/',
                '-f',
                '--OUTPUT=OLDXML',
            ],
            null,
            [
                'MEDIAINFO_VAR_FILE_PATH'    => 'http://example.org/',
                'MEDIAINFO_VAR_FULL_DISPLAY' => '-f',
                'MEDIAINFO_VAR_OUTPUT'       => '--OUTPUT=OLDXML',
                'LANG'                       => 'en_US.UTF-8',
            ]
        ));

        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);
    }

    public function testExceptionWithNonExistingFile(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File "non existing path" does not exist');
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('non existing path');
    }

    public function testExceptionWithDirectory(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Expected a filename, got ".", which is a directory');
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('.');
    }

    public function testBuilderCommand(): void
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner($this->filePath);

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner(new Process(
            [
                'mediainfo',
                $this->filePath,
                '-f',
                '--OUTPUT=OLDXML',
            ],
            null,
            [
                'MEDIAINFO_VAR_FILE_PATH'    => $this->filePath,
                'MEDIAINFO_VAR_FULL_DISPLAY' => '-f',
                'MEDIAINFO_VAR_OUTPUT'       => '--OUTPUT=OLDXML',
                'LANG'                       => 'en_US.UTF-8',
            ]
        ));

        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);
    }

    public function testConfiguredCommand(): void
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner(
            $this->filePath,
            [
                'command'                            => '/usr/bin/local/mediainfo',
                'use_oldxml_mediainfo_output_format' => false,
                'urlencode'                          => true,
                'include_cover_data'                 => true,
            ]
        );

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner(new Process(
            [
                '/usr/bin/local/mediainfo',
                $this->filePath,
                '-f',
                '--OUTPUT=XML',
                '--urlencode',
                '--Cover_Data=base64',
            ],
            null,
            [
                'MEDIAINFO_VAR_FILE_PATH'    => $this->filePath,
                'MEDIAINFO_VAR_FULL_DISPLAY' => '-f',
                'MEDIAINFO_VAR_OUTPUT'       => '--OUTPUT=XML',
                'MEDIAINFO_VAR_URLENCODE'    => '--urlencode',
                'MEDIAINFO_COVER_DATA'       => '--Cover_Data=base64',
                'LANG'                       => 'en_US.UTF-8',
            ]
        ));

        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);
    }
}
