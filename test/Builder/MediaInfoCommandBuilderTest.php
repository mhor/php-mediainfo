<?php

namespace Mhor\MediaInfo\test\Builder;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;

class MediaInfoCommandBuilderTest extends \PHPUnit_Framework_TestCase
{
    private $filePath;

    public function setUp()
    {
        $this->filePath = __DIR__.'/../fixtures/test.mp3';
    }

    /**
     * @expectedException \Exception
     */
    public function testExceptionWithNonExistingFile()
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandBuilder->buildMediaInfoCommandRunner('non existing path');
    }

    public function testBuilderCommand()
    {
        $mediaInfoCommandBuilder = new MediaInfoCommandBuilder();
        $mediaInfoCommandRunner = $mediaInfoCommandBuilder->buildMediaInfoCommandRunner($this->filePath);

        $equalsMediaInfoCommandRunner = new MediaInfoCommandRunner($this->filePath);
        $this->assertEquals($equalsMediaInfoCommandRunner, $mediaInfoCommandRunner);
    }
}
