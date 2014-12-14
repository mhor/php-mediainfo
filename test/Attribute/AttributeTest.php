<?php

namespace Mhor\MediaInfo\Test\Attribute;

use Mhor\MediaInfo\Attribute\Cover;
use Mhor\MediaInfo\Attribute\Duration;
use Mhor\MediaInfo\Attribute\Mode;
use Mhor\MediaInfo\Attribute\Rate;
use Mhor\MediaInfo\Attribute\Size;

class AttributeTest extends \PHPUnit_Framework_TestCase
{
    public function testCover()
    {
        $cover = new Cover('binary_string');
        $this->assertEquals('binary_string', $cover->getBinaryCover());
    }

    public function testDuration()
    {
        $duration = new Duration(1000);
        $this->assertEquals(1000, $duration->getMilliseconds());
    }

    public function testMode()
    {
        $mode = new Mode('short', 'full');
        $this->assertEquals('short', $mode->getShortName());
        $this->assertEquals('full', $mode->getFullName());
    }

    public function testRate()
    {
        $rate = new Rate(15555, '15.55 Mo');
        $this->assertEquals(15555, $rate->getAbsoluteValue());
        $this->assertEquals('15.55 Mo', $rate->getTextValue());
    }

    public function testSize()
    {
        $size = new Size(42);
        $this->assertEquals(42, $size->getBit());
    }
}
