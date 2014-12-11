<?php

namespace Mhor\MediaInfo\test\Parser;

use Mhor\MediaInfo\Parser\MediaInfoOutputParser;

class MediaInfoOutputParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $outputPath;

    public function setUp()
    {
        $this->outputPath = __DIR__.'/../fixtures/mediainfo-output.xml';
    }

    /**
     * @expectedException \Exception
     */
    public function testGetMediaInfoContainerBeforeCallParse()
    {
        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->getMediaInfoContainer();
    }

    public function testGetMediaInfoContainer()
    {
        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->parse(file_get_contents($this->outputPath));
        $mediaInfoContainer = $mediaInfoOutputParser->getMediaInfoContainer();

        $this->assertEquals('Mhor\MediaInfo\Container\MediaInfoContainer', get_class($mediaInfoContainer));

        $this->assertEquals(1, count($mediaInfoContainer->getAudios()));
        $this->assertEquals(0, count($mediaInfoContainer->getVideos()));
        $this->assertEquals(0, count($mediaInfoContainer->getImages()));
        $this->assertEquals('Mhor\MediaInfo\Type\General', get_class($mediaInfoContainer->getGeneral()));

        $this->assertEquals(1, count($mediaInfoContainer->getAudios()));

        $audios = $mediaInfoContainer->getAudios();
        $this->assertEquals(20, count($audios[0]->get()));
        $this->assertEquals(33, count($mediaInfoContainer->getGeneral()->get()));
    }
}
