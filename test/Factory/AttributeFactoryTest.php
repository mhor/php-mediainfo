<?php

namespace Mhor\MediaInfo\Test\Factory;

use Mhor\MediaInfo\Factory\AttributeFactory;

class AttributeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateRatio()
    {
        $ratio = AttributeFactory::create(
            'display_aspect_ratio',
            array(
                '15.55',
                '15.55 Mo',
            )
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Ratio', get_class($ratio));
    }

    public function testCreateRate()
    {
        $rate = AttributeFactory::create(
            'height',
            array(
                '720',
                '720p',
            )
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Rate', get_class($rate));
    }

    public function testCreateSize()
    {
        $size = AttributeFactory::create(
            'file_size',
            array(
                '19316079',
                '18.4 MiB',
            )
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Size', get_class($size));
    }

    public function testCreateMode()
    {
        $mode = AttributeFactory::create(
            'overall_bit_rate',
            array(
                'CBR',
                'Constant',
            )
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Mode', get_class($mode));
    }

    public function testCreateDuration()
    {
        $duration = AttributeFactory::create(
            'duration',
            array(
                '475193',
            )
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Duration', get_class($duration));
    }

    public function testCreateCover()
    {
        $cover = AttributeFactory::create(
            'cover_data',
            array(
                '01010101',
            )
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Cover', get_class($cover));
    }
}
