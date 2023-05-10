<?php

namespace Mhor\MediaInfo\Tests\Attribute;

use Mhor\MediaInfo\Attribute\Cover;
use Mhor\MediaInfo\Attribute\Duration;
use Mhor\MediaInfo\Attribute\FloatRate;
use Mhor\MediaInfo\Attribute\Mode;
use Mhor\MediaInfo\Attribute\Rate;
use Mhor\MediaInfo\Attribute\Ratio;
use Mhor\MediaInfo\Attribute\Size;
use PHPUnit\Framework\TestCase;

class AttributeTest extends TestCase
{
    public function testCover(): void
    {
        $cover = new Cover('binary_string');
        $this->assertEquals('binary_string', $cover->getBinaryCover());
        $this->assertSame('binary_string', (string) $cover);
    }

    public function testDuration(): void
    {
        $duration = new Duration('1000');
        $this->assertSame(1000, $duration->getMilliseconds());
        $this->assertTrue(is_int($duration->getMilliseconds()));
        $this->assertSame('1000', (string) $duration);
    }

    public function testMode(): void
    {
        $mode = new Mode('short', 'full');
        $this->assertEquals('short', $mode->getShortName());
        $this->assertEquals('full', $mode->getFullName());
        $this->assertSame('short', (string) $mode);
    }

    public function testRatio(): void
    {
        $ratio = new Ratio('15555', '15.55 Mo');
        $this->assertSame(15555.0, $ratio->getAbsoluteValue());
        $this->assertTrue(is_float($ratio->getAbsoluteValue()));
        $this->assertEquals('15.55 Mo', $ratio->getTextValue());
        $this->assertSame('15.55 Mo', (string) $ratio);
    }

    public function testRate(): void
    {
        $rate = new Rate('720', '720p');
        $this->assertSame(720, $rate->getAbsoluteValue());
        $this->assertTrue(is_int($rate->getAbsoluteValue()));
        $this->assertEquals('720p', $rate->getTextValue());
        $this->assertSame('720p', (string) $rate);
    }

    public function testFloatRate(): void
    {
        $rate = new FloatRate('46.875', '46.875 FPS (1024 SPF)');
        $this->assertSame(47, $rate->getAbsoluteValue());
        $this->assertSame(46.875, $rate->getFloatAbsoluteValue());
        $this->assertTrue(is_int($rate->getAbsoluteValue()));
        $this->assertTrue(is_float($rate->getFloatAbsoluteValue()));
        $this->assertEquals('46.875 FPS (1024 SPF)', $rate->getTextValue());
        $this->assertSame('46.875 FPS (1024 SPF)', (string) $rate);
    }

    public function testSize(): void
    {
        $size = new Size('42');
        $this->assertSame(42, $size->getBit());
        $this->assertTrue(is_int($size->getBit()));
        $this->assertSame('42', (string) $size);
    }
}
