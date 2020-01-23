<?php

namespace Mhor\MediaInfo\Test\Attribute;

use Mhor\MediaInfo\Attribute\Cover;
use Mhor\MediaInfo\Attribute\Duration;
use Mhor\MediaInfo\Attribute\Mode;
use Mhor\MediaInfo\Attribute\Rate;
use Mhor\MediaInfo\Attribute\Ratio;
use Mhor\MediaInfo\Attribute\Size;
use PHPUnit\Framework\TestCase;

class AttributeTest extends TestCase
{
    public function testCover()
    {
        $cover = new Cover('binary_string');
        $this->assertEquals('binary_string', $cover->getBinaryCover());
        $this->assertSame('binary_string', (string) $cover);
    }

    public function testDuration()
    {
        $duration = new Duration('1000');
        $this->assertSame(1000, $duration->getMilliseconds());
        $this->assertTrue(is_int($duration->getMilliseconds()));
        $this->assertSame('1000', (string) $duration);
    }

    public function testMode()
    {
        $mode = new Mode('short', 'full');
        $this->assertEquals('short', $mode->getShortName());
        $this->assertEquals('full', $mode->getFullName());
        $this->assertSame('short', (string) $mode);
    }

    public function testRatio()
    {
        $ratio = new Ratio('15555', '15.55 Mo');
        $this->assertSame(15555.0, $ratio->getAbsoluteValue());
        $this->assertTrue(is_float($ratio->getAbsoluteValue()));
        $this->assertEquals('15.55 Mo', $ratio->getTextValue());
        $this->assertSame('15.55 Mo', (string) $ratio);
    }

    public function testRate()
    {
        $rate = new Rate('720', '720p');
        $this->assertSame(720, $rate->getAbsoluteValue());
        $this->assertTrue(is_int($rate->getAbsoluteValue()));
        $this->assertEquals('720p', $rate->getTextValue());
        $this->assertSame('720p', (string) $rate);
    }

    public function testSize()
    {
        $size = new Size('42');
        $this->assertSame(42, $size->getBit());
        $this->assertTrue(is_int($size->getBit()));
        $this->assertSame('42', (string) $size);
    }
}
