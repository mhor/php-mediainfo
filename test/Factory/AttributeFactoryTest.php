<?php

namespace Mhor\MediaInfo\Test\Factory;

use Mhor\MediaInfo\Factory\AttributeFactory;
use PHPUnit\Framework\TestCase;

class AttributeFactoryTest extends TestCase
{
    public function testCreateRatio()
    {
        $ratio = AttributeFactory::create(
            'display_aspect_ratio',
            [
                '15.55',
                '15.55 Mo',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Ratio', get_class($ratio));
    }

    public function testCreateRate()
    {
        $rate = AttributeFactory::create(
            'height',
            [
                '720',
                '720p',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Rate', get_class($rate));
    }

    public function testCreateSize()
    {
        $size = AttributeFactory::create(
            'file_size',
            [
                '19316079',
                '18.4 MiB',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Size', get_class($size));
    }

    public function testCreateMode()
    {
        $mode = AttributeFactory::create(
            'overall_bit_rate',
            [
                'CBR',
                'Constant',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Mode', get_class($mode));
    }

    public function testCreateDuration()
    {
        $duration = AttributeFactory::create(
            'duration',
            [
                '475193',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Duration', get_class($duration));
    }

    public function testCreateCover()
    {
        $cover = AttributeFactory::create(
            'cover_data',
            [
                '01010101',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Cover', get_class($cover));
    }
}
