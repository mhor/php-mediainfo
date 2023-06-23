<?php

namespace Mhor\MediaInfo\Tests\Parser;

use Mhor\MediaInfo\Configuration\Configuration;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Exception\MediainfoOutputParsingException;
use Mhor\MediaInfo\Exception\UnknownTrackTypeException;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;
use Mhor\MediaInfo\Tests\Stub\Attribute\CustomDuration;
use Mhor\MediaInfo\Tests\Stub\Checker\CustomDurationChecker;
use PHPUnit\Framework\TestCase;

class MediaInfoOutputParserTest extends TestCase
{
    /**
     * @var string
     */
    private $outputPath;

    /**
     * @var string
     */
    private $invalidOutputPath;

    /**
     * @var string
     */
    private $outputMediainfo1710Path;

    protected function setUp(): void
    {
        $this->outputPath = __DIR__.'/../fixtures/mediainfo-output.xml';
        $this->outputMediainfo1710Path = __DIR__.'/../fixtures/mediainfo-17.10-output.xml';
        $this->invalidOutputPath = __DIR__.'/../fixtures/mediainfo-output-invalid-types.xml';
    }

    public function testGetMediaInfoContainerBeforeCallParse(): void
    {
        $this->expectException(\Exception::class);

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $mediaInfoOutputParser->getMediaInfoContainer(new Configuration(), null);
    }

    public function testGetMediaInfoContainer(): void
    {
        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $parsedOutput = $mediaInfoOutputParser->parse(file_get_contents($this->outputPath));
        $mediaInfoContainer = $mediaInfoOutputParser->getMediaInfoContainer(new Configuration(), $parsedOutput);

        $this->assertEquals('Mhor\MediaInfo\Container\MediaInfoContainer', get_class($mediaInfoContainer));

        $this->assertEquals(1, count($mediaInfoContainer->getAudios()));
        $this->assertEquals(0, count($mediaInfoContainer->getVideos()));
        $this->assertEquals(0, count($mediaInfoContainer->getImages()));
        $this->assertEquals('Mhor\MediaInfo\Type\General', get_class($mediaInfoContainer->getGeneral()));

        $this->assertEquals(1, count($mediaInfoContainer->getAudios()));
        $this->assertEquals(1, count($mediaInfoContainer->getMenus()));

        $audios = $mediaInfoContainer->getAudios();
        $this->assertEquals(20, is_array($audios[0]->get()) || $audios[0]->get() instanceof \Countable ? count($audios[0]->get()) : 0);
        $this->assertEquals(20974464, $audios[0]->get('samples_count'));
        $this->assertEquals(null, $audios[0]->get('test'));

        $subtitles = $mediaInfoContainer->getSubtitles();
        $this->assertEquals(16, is_array($subtitles[0]->get()) || $subtitles[0]->get() instanceof \Countable ? count($subtitles[0]->get()) : 0);

        $this->assertTrue($subtitles[0]->has('commercial_name'));
        $this->assertFalse($subtitles[0]->has('unexisting_attribute'));

        $this->assertCount(16, $subtitles[0]->list());
        $this->assertArrayHasKey('commercial_name', array_flip($subtitles[0]->list()));
        $this->assertArrayNotHasKey('unexisting_attribute', array_flip($subtitles[0]->list()));
    }

    public function testIgnoreInvalidTrackType(): void
    {
        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $parsedOutput = $mediaInfoOutputParser->parse(file_get_contents($this->invalidOutputPath));

        $config = (new Configuration())
            ->setIgnoreUnknownTrackTypes(true)
            ->setAttributeCheckers([new CustomDurationChecker()]);

        // the xml specifically has an unknown type in it
        // when passing true we want to ignore/skip unknown track types
        $mediaInfoContainer = $mediaInfoOutputParser->getMediaInfoContainer($config, $parsedOutput);
        $this->assertInstanceOf(MediaInfoContainer::class, $mediaInfoContainer);

        $this->assertInstanceOf(CustomDuration::class, $mediaInfoContainer->getGeneral()->get('duration'));
        $this->assertEquals(475.193, $mediaInfoContainer->getGeneral()->get('duration')->getSeconds());
    }

    public function testThrowMediaInfoOutputParsingException(): void
    {
        $this->expectException(MediainfoOutputParsingException::class);

        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $parsedOutput = $mediaInfoOutputParser->parse(file_get_contents($this->outputMediainfo1710Path));

        // will throw exception here as default behavior
        $mediaInfoOutputParser->getMediaInfoContainer(new Configuration(), $parsedOutput);
    }

    public function testThrowInvalidTrackType(): void
    {
        $this->expectException(UnknownTrackTypeException::class);
        $mediaInfoOutputParser = new MediaInfoOutputParser();
        $parsedOutput = $mediaInfoOutputParser->parse(file_get_contents($this->invalidOutputPath));

        // will throw exception here as default behavior
        $mediaInfoOutputParser->getMediaInfoContainer(new Configuration(), $parsedOutput);
    }
}
