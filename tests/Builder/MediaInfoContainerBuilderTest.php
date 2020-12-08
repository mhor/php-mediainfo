<?php

namespace Mhor\MediaInfo\Tests\Builder;

use Mhor\MediaInfo\Attribute\Duration;
use Mhor\MediaInfo\Builder\MediaInfoContainerBuilder;
use Mhor\MediaInfo\Exception\UnknownTrackTypeException;
use Mhor\MediaInfo\Factory\TypeFactory;
use Mhor\MediaInfo\Tests\Stub\TrackTestType;
use PHPUnit\Framework\TestCase;

class MediaInfoContainerBuilderTest extends TestCase
{
    public function testSetVersion(): void
    {
        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();

        $mediaContainer = $mediaInfoContainerBuilder->build();
        $this->assertEquals(null, $mediaContainer->getVersion());

        $mediaInfoContainerBuilder->setVersion('2.0');
        $mediaContainer = $mediaInfoContainerBuilder->build();

        $this->assertEquals('2.0', $mediaContainer->getVersion());
    }

    public function testAddTrackType(): void
    {
        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();

        $mediaInfoContainerBuilder->addTrackType(TypeFactory::AUDIO, []);
        $mediaContainer = $mediaInfoContainerBuilder->build();
        $audios = $mediaContainer->getAudios();
        $this->assertEquals(0, is_array($audios[0]->get()) || $audios[0]->get() instanceof \Countable ? count($audios[0]->get()) : 0);

        $mediaInfoContainerBuilder->addTrackType(TypeFactory::VIDEO, []);
        $mediaContainer = $mediaInfoContainerBuilder->build();
        $videos = $mediaContainer->getVideos();
        $this->assertEquals(0, is_array($videos[0]->get()) || $videos[0]->get() instanceof \Countable ? count($videos[0]->get()) : 0);

        $mediaInfoContainerBuilder->addTrackType(TypeFactory::GENERAL, []);
        $mediaContainer = $mediaInfoContainerBuilder->build();
        $this->assertEquals(0, is_array($mediaContainer->getGeneral()->get()) || $mediaContainer->getGeneral()->get() instanceof \Countable ? count($mediaContainer->getGeneral()->get()) : 0);

        $mediaInfoContainerBuilder->addTrackType(TypeFactory::IMAGE, []);
        $mediaContainer = $mediaInfoContainerBuilder->build();
        $images = $mediaContainer->getImages();
        $this->assertEquals(0, is_array($images[0]->get()) || $images[0]->get() instanceof \Countable ? count($images[0]->get()) : 0);

        $mediaInfoContainerBuilder->addTrackType(TypeFactory::SUBTITLE, []);
        $mediaContainer = $mediaInfoContainerBuilder->build();
        $subtitles = $mediaContainer->getSubtitles();
        $this->assertEquals(0, is_array($subtitles[0]->get()) || $subtitles[0]->get() instanceof \Countable ? count($subtitles[0]->get()) : 0);

        $mediaInfoContainerBuilder->addTrackType(TypeFactory::OTHER, []);
        $mediaContainer = $mediaInfoContainerBuilder->build();
        $others = $mediaContainer->getOthers();
        $this->assertEquals(0, is_array($others[0]->get()) || $others[0]->get() instanceof \Countable ? count($others[0]->get()) : 0);
    }

    public function testAddInvalidType(): void
    {
        $this->expectException(UnknownTrackTypeException::class);
        $this->expectExceptionMessage('Type doesn\'t exist: InvalidType');

        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();
        $mediaInfoContainerBuilder->addTrackType('InvalidType', []);

        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();

        $mediaInfoContainerBuilder->addTrackType('InvalidType', []);
    }

    public function testAddInvalidTypeOnMediaInfoContainer(): void
    {
        $this->expectException(\Exception::class);
        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();
        $mediaInfoContainer = $mediaInfoContainerBuilder->build();
        $mediaInfoContainer->add(new TrackTestType());
    }

    public function attributesProvider(): array
    {
        return [
            [
                [
                    'Duration' => '10',
                    'DuRatioN' => '20',
                    'DURATION' => '4000',
                ],
            ],
            [
                [
                    'Duration' => ['10', '30', '40'],
                    'DuRatioN' => '20',
                    'DURATION' => '4000',
                ],
            ],
            [
                [
                    'Duration' => '10',
                    'DuRatioN' => '20',
                    'DURATION' => ['60', '70', '80'],
                ],
            ],
        ];
    }

    /**
     * @dataProvider attributesProvider
     */
    public function testSanitizeAttributes(array $attributes): void
    {
        $mediaInfoContainerBuilder = new MediaInfoContainerBuilder();
        $mediaInfoContainerBuilder->addTrackType(TypeFactory::AUDIO, $attributes);

        $mediaContainer = $mediaInfoContainerBuilder->build();
        $audios = $mediaContainer->getAudios();

        $this->assertEquals('Mhor\MediaInfo\Attribute\Duration', get_class($audios[0]->get('duration')));

        /** @var Duration $duration */
        $duration = $audios[0]->get('duration');
        $this->assertEquals('10', $duration->getMilliseconds());
    }
}
