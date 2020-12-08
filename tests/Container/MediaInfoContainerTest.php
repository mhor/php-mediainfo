<?php

namespace Mhor\MediaInfo\Tests\Container;

use Mhor\MediaInfo\Attribute\Duration;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Type\Audio;
use Mhor\MediaInfo\Type\General;
use PHPUnit\Framework\TestCase;

class MediaInfoContainerTest extends TestCase
{
    private function createContainer(): \Mhor\MediaInfo\Container\MediaInfoContainer
    {
        $mediaInfoContainer = new MediaInfoContainer();
        $general = new General();

        $general->set('Format', 'MPEG Audio');
        $general->set('Duration', new Duration('1200000'));

        $audio = new Audio();

        $audio->set('Format', 'MPEG Audio');
        $audio->set('Bit rate', '56.0 Kbps');

        $mediaInfoContainer->add($audio);
        $mediaInfoContainer->add($general);

        return $mediaInfoContainer;
    }

    public function testToJson(): void
    {
        $mediaInfoContainer = $this->createContainer();

        $data = json_encode($mediaInfoContainer);

        $this->assertRegExp('/^\{.+\}$/', $data);
    }

    public function testToJsonType(): void
    {
        $mediaInfoContainer = $this->createContainer();

        $data = json_encode($mediaInfoContainer->getGeneral());

        $this->assertRegExp('/^\{.+\}$/', $data);
    }

    public function testToArray(): void
    {
        $mediaInfoContainer = $this->createContainer();

        $array = $mediaInfoContainer->__toArray();

        $this->assertArrayHasKey('version', $array);
    }

    public function testToArrayType(): void
    {
        $mediaInfoContainer = $this->createContainer();

        $array = $mediaInfoContainer->getGeneral()->__toArray();

        $this->assertTrue(is_array($array));
    }

    public function testToXML(): void
    {
        $mediaInfoContainer = $this->createContainer();

        $xml = $mediaInfoContainer->__toXML();

        $this->assertInstanceOf('SimpleXMLElement', $xml);
    }

    public function testToXMLType(): void
    {
        $mediaInfoContainer = $this->createContainer();

        $general = $mediaInfoContainer->getGeneral();

        $xml = $general->__toXML();

        $this->assertInstanceOf('SimpleXMLElement', $xml);
    }
}
